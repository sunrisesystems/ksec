<?php namespace ksec\Services;

use ksec\Shift;
use ksec\Machine;
use ksec\Product;
use ksec\DailyEntry;
use ksec\Defect;
use ksec\Color;
use ksec\Rejection;
use ksec\DailyEntryMachine;
use ksec\DailyEntryDowntime;
use ksec\RejectionInwardDetail;
use ksec\DowntimeSubreason;
use ksec\Invert;
use ksec\PackingMatrix;
use ksec\InvertDetail;
use ksec\HourlyEntry;
use ksec\HourlyEntryDetail;
use ksec\Item;
use ksec\CodeValue;
use ksec\DailyEntryRejection;
use ksec\Services\PlanningService;
use ksec\Services\ProductService;
use Request,Config,Lang,Sentinel,DB;
use ksec\Libraries\Lib;
use ksec\Dto\DailyEntryDTO;
use ksec\Dto\HourlyEntryDTO;
use ksec\Dto\RejectionEntryDTO;
use ksec\Dto\MasterDTO;

class TransactionService {

    public function __construct(Shift $shift,
    							Machine $machine,
    							PlanningService $planningService,
    							DailyEntry $dailyEntry,
    							DailyEntryMachine $dailyEntryMachine,
    							Product $product,
                                Defect $defect,
                                DailyEntryRejection $dailyEntryRejection,
                                DowntimeSubreason $downtimeSubreason,
                                DailyEntryDowntime $dailyEntryDowntime,
                                Invert $invert,
                                InvertDetail $invertDetail,
                                Item $item,
                                PackingMatrix $packingMatrix,
                                CodeValue $codeValue,
                                Rejection $rejection,
                                Color $color,
                                RejectionInwardDetail $rejectionInwardDetail,
                                HourlyEntry $hourlyEntry,
                                HourlyEntryDetail $hourlyEntryDetail,
                                ProductService $productService)
    {
        $this->shift = $shift;
        $this->hourlyEntry = $hourlyEntry;
        $this->codeValue = $codeValue;
        $this->machine = $machine;
		$this->user = Sentinel::getUser();
		$this->planningService = $planningService;
		$this->dailyEntry = $dailyEntry;
		$this->dailyEntryMachine = $dailyEntryMachine;
		$this->product = $product;
        $this->defect = $defect;
        $this->dailyEntryRejection = $dailyEntryRejection;
        $this->downtimeSubreason = $downtimeSubreason;
        $this->dailyEntryDowntime = $dailyEntryDowntime;
        $this->invert = $invert;
        $this->invertDetail = $invertDetail;
        $this->item = $item;
        $this->packingMatrix = $packingMatrix;
        $this->rejection = $rejection;
        $this->color = $color;
        $this->rejectionInwardDetail = $rejectionInwardDetail;
        $this->hourlyEntryDetail = $hourlyEntryDetail;
        $this->productService = $productService;
	}

	public function getShifts()
	{
		$user = $this->user;
		return Lib::addSelect($this->shift->getShiftListByUnit($user->unit_id));
	}

    public function getShiftTiminings()
    {
        $shiftData = [];
        $user = $this->user;
        $shifts = $this->shift->getShifts($user->unit_id);
        
        if(!empty($shifts)){
            foreach ($shifts as $key => $value) {
                $d = [
                    'shiftId' => $value['id'],
                ];
                $d['allowTime'] = Lib::getShiftTiming($value['start_time'],$value['end_time']);
                $shiftData[] = $d;
            }
        }
        return $shiftData;
    }

    public function getAllData()
    {
       $data = [];
       $data['shift'] = $this->getShifts();
       return $data;
    }

    public function getDailyEntryData($input)
    {
        $user = $this->user;
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $input['unitId'] = $user->unit_id;
        if(isset($input['date']) && !empty($input['date'])){
            $input['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],'Y-m-d');
        }
        $dailyEntries = $this->dailyEntry->getDailyEntry($input);
        $listArr = [];
        $masterDTO = new MasterDTO();
        if(count($dailyEntries)){
            foreach ($dailyEntries as $key => $value) {
                
                $dto = new DailyEntryDTO();
                $dto->setId($value->id);
                $dto->setShift($value->shift_id);
                $dto->setUpdatedTime(Lib::convertDateFormat("Y-m-d H:i:s",$value->updated_at,"d-m-Y H:i"));
                $dto->setDate(Lib::convertDateFormat("Y-m-d",$value->date,"d-m-Y"));
                $dto->setIsCompleted($value->is_completed);
                // get total downtime
                $totalDowntime = $this->dailyEntryMachine->getTotalDowntimeByDailyEntryId($value->id);
                $t = explode(":", $totalDowntime[0]->totalDowntime);
                if(!empty($t[0])){
                    $dto->setTotalDowntime($t[0].":".$t[1]);
                }
                if($value->date == date("Y-m-d") || $value->date == date("Y-m-d",strtotime("yesterday"))){
                    $dto->setAllowDelete('Y');
                }else{
                    $dto->setAllowDelete('N');
                }
                //get total rejection
                $totalRejection = $this->dailyEntryMachine->getTotalRejectionByDailyEntryId($value->id);
                $dto->setTotalRejection($totalRejection);
                // get total machine count
                $totalMachine = $this->dailyEntryMachine->getMachineCountByDailyEntryId($value->id);
                $dto->setTotalMachine($totalMachine);

                $listArr[] = $dto;
            }
        }
        $masterDTO->setListDTO($listArr);
        $masterDTO->setCount($dailyEntries->currentPage());
        $dailyEntries->appends(Request::except('page'))->render();
        $masterDTO->setLinks($dailyEntries->render());
        return $masterDTO;
    }

	public function loadAllMachines($input)
	{
		$user = $this->user;

		$response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
        	// check data already exists for the given date and shift
        	$checkData['unitId'] = $user->unit_id;
        	$checkData['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d");
        	$checkData['shift'] = $input['shift'];
        	$alreadyExists = $this->dailyEntry->checkRecord($checkData);
        	$machineList = $this->machine->getMachineByUnitId($user->unit_id);

	        $productList = $this->product->getProductList();
	        // get shifts start time and end time
	        $shift = $this->shift->getShiftById($input['shift']);
	        $shiftHrs = Lib::getShiftHrs($shift->start_time,$shift->end_time);
        	$shiftTiming = Lib::getShiftStartEndTime($input['date'],$shift->start_time,$shiftHrs);  
        	$response['shiftTiming'] = Lib::formatAllowDateAndTime($shiftTiming);

        	if(count($alreadyExists)){
                $response['isCompleted'] = $alreadyExists->is_completed;
        		$response['daliyEntryId'] = $alreadyExists->id;
        		// get data from daily entry
        		$finalData = [];
				// get all date related to daily entry id 
				$entriedMachines = $this->dailyEntryMachine->getDataByDailyEntryId($alreadyExists->id);
				foreach ($entriedMachines as $key => $value) {
					$data = [];
					$data = [
						'id' => $value->id,
						'planId' => $value->plan_id,
						'machineId' => $value->machine_id,
						'productId' => $value->product_id,
						'machine' => $machineList[$value->machine_id],
						'product' => $productList[$value->product_id],
						'endShortCounter' => $value->end_short_counter,
						'productionQuantity' => $value->production_quantity,
                        'purging' => $value->purging,
                        'isCompleted' => $value->is_completed,
                        'totalRejection' => $value->total_rejection,
                        'totalDowntime' => $value->total_downtime,
                        'shortCounterTime' => Lib::convertDateFormat("Y-m-d H:i:s",$value->short_counter_time,"d-m-Y H:i"),
                    ];
                    // get total rejection from rejection table
                    $rejectionRecords = $this->dailyEntryRejection->getTotalRejectionByDailyEntryMachineId($value->id);
                    $data['rejectionRecords'] = $rejectionRecords;
                    $t = explode(":", $data['totalDowntime']);
                    if(!empty($t[0])){
                        $data['totalDowntime'] = $t[0].":".$t[1];
                    }
                    $finalData[] = $data;
                }
                $response['data'] = $finalData;
                $response['success'] = 1;
            }else{
                //if(count($shift)){
                // get all the machine list from the unit
                //check all machines are there or not
                $data1 = $shiftTiming;
                $data1['unitId'] = $user->unit_id;
              //  $activeMachines = $this->planningService->getActiveMachineListUnitWise($data1); 
                $response['isCompleted'] = 'N';

                if(!empty($machineList)){
                    // get active plans for all those machines for that time
                    $data = $shiftTiming;
                    $data['machineIds'] = array_keys($machineList);
                    $activePlans = $this->planningService->getPlansForDailyEntry($data); 
                   
                    if(count($activePlans)){
                        // insert all these things into dialy_entries and daily entry machines table
                        DB::beginTransaction();
                        $dailyInsert = [
                            'date' => Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d"),
                            'shift_id' => $input['shift'],
                            'unit_id' => $user->unit_id,
                            'created_by_id' => $user->id,
                            'updated_by_id' => $user->id,
                        ];
                        $dailyInsertSucc = $this->dailyEntry->saveDailyEntry($dailyInsert);
                        if(count($dailyInsertSucc)){
                            $response['daliyEntryId'] = $dailyInsertSucc->id;
                            // save many records at a time
                            $i = 0;
                            foreach ($activePlans as $key => $value) {
                                $machines[$i] = new DailyEntryMachine();
                                $machines[$i]['machine_id'] = $value->machine_id;
                                $machines[$i]['product_id'] = $value->product_id;
                                $machines[$i]['plan_id'] = $value->id;
                                $machines[$i]['created_by_id'] = $user->id;
                                $machines[$i]['updated_by_id'] = $user->id;
                                $i++;
                            }

                            /* insert data in daily entry machines table */
                            $machineInsertion = $this->dailyEntry->saveDailyEntryMachine($machines,$dailyInsertSucc->id);
                            if(count($machineInsertion)){
                                $finalData = [];
                                // get all date related to daily entry id 
                                $entriedMachines = $this->dailyEntryMachine->getDataByDailyEntryId($dailyInsertSucc->id);
                                foreach ($entriedMachines as $key => $value) {
                                    $data = [];
                                    $data = [
                                        'id' => $value->id,
                                        'planId' => $value->plan_id,
                                        'machineId' => $value->machine_id,
                                        'productId' => $value->product_id,
                                        'machine' => $machineList[$value->machine_id],
                                        'product' => $productList[$value->product_id],
                                        'endShortCounter' => $value->end_short_counter,
                                        'productionQuantity' => $value->production_quantity,
                                        'purging' => $value->purging,
                                        'isCompleted' => $value->is_completed,
                                        'totalRejection' => $value->total_rejection,
						                'totalDowntime' => $value->total_downtime,
                                        'shortCounterTime' => Lib::convertDateFormat("Y-m-d H:i:s",$value->short_counter_time,"d-m-Y H:i"),
                                    ];

                                    $rejectionRecords = $this->dailyEntryRejection->getTotalRejectionByDailyEntryMachineId($value->id);
                                    $data['rejectionRecords'] = $rejectionRecords;
                                    $t = explode(":", $data['totalDowntime']);
                                    if(!empty($t[0])){
                                        $data['totalDowntime'] = $t[0].":".$t[1];
                                    }
                                    $finalData[] = $data;
            					}
            					$response['data'] = $finalData;
            					$response['success'] = 1;
            					DB::commit();
            				}else{
            					DB::rollback();
            				}
        				}else{
        					DB::rollback();
        				}
        			}else{
        				$response['data'] = Lang::get('messages.no_active_plans_available');
        			}
        		}
	        	//}
        	}
        } catch (Exception $e) {
        	DB::rollback();
        	$response['data'] = "TransactionService::loadAllMachines ".$e->getMessage();
        }
      //  Lib::pr($response); exit;
        return $response;
	}

	public function saveDailyEntry($input)
	{
        //Lib::pr($input); exit;
		$user = $this->user;

		$response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
        	DB::beginTransaction();
        	// step 1 - form all data
        	$machines = [];
        	$i = 0;
        	foreach ($input['dailyEntryMachine'] as $key => $value) {
        	//	$machines[$i] = new DailyEntryMachine();
				$machines[$i]['id'] = $value;
				if($input['shortCounter'][$value] != ''){
					$machines[$i]['end_short_counter'] = $input['shortCounter'][$value];
				}
				if(!empty($input['shortCounterTimer'][$value])){
					$machines[$i]['short_counter_time'] = Lib::convertDateFormat("d-m-Y H:i",$input['shortCounterTimer'][$value],"Y-m-d H:i:s");
	
				}
				if($input['purging'][$value] != ''){
                    $machines[$i]['purging'] = $input['purging'][$value];
                }

				if($input['productionQuantity'][$value] != ''){
					$machines[$i]['production_quantity'] = $input['productionQuantity'][$value];
				}

                if($input['totalRejection'][$value] != ''){
                    $machines[$i]['total_rejection'] = $input['totalRejection'][$value];
                }

                if(isset($input['isCompleted'][$value]) && $input['isCompleted'][$value] == 'Y'){
                    $machines[$i]['is_completed'] = 'Y';
                }else{
                    $machines[$i]['is_completed'] = 'N';
                }
				$machines[$i]['updated_by_id'] = $user->id;
				$i++;
        	}
        	// update table with relationship
        	$update['updated_by_id'] = $user->id;
            $update['updated_at'] = date("Y-m-d H:i:s");
        	$updateSucc = $this->dailyEntry->updateDailyEntry($update,$input['dailyEntry']);
        	if($updateSucc){
        		// update machines
                unset($update);
        		$result = $this->dailyEntryMachine->updateDailyEntryMachine($machines);
        		if($result){
                    if($input['dailyEntryCompleted'] == 'Y'){
                        // get shift hrs
                        $dailyEntryDetail = $this->dailyEntry->getById($input['dailyEntry']);

                        // get shift details
                        $shiftDetail = $this->shift->getShiftById($dailyEntryDetail->shift_id);

                        $shiftHrs = Lib::getShiftHrs($shiftDetail->start_time,$shiftDetail->end_time);

                        // get date from dailyEntry
                        $entryDate = $this->dailyEntry->getDateById($input['dailyEntry']);

                        $shiftTiming = Lib::getShiftStartEndTime($entryDate,$shiftDetail->start_time,$shiftHrs);
                        // get all machineids which are there in daily entry
                        $machineList = $this->dailyEntryMachine->getMachineListByDailyEntry($input['dailyEntry']);
                        $cnt = array_count_values($machineList);
                        
                        $i = 0;
                        $machineUp = [];
                        $machineIdList = [];
                        foreach ($machineList as $key => $value) {
                            $mCount = $cnt[$value];
                            if($mCount > 1){
                                $machineIdList[$value] = $mCount;
                            }else{
                                // available hrs shift end - shift start
                                $machineUp[$i]['id'] = $key;
                                $machineUp[$i]['available_hrs'] = Lib::convertToTime($shiftHrs,0);
                            }
                            $i++;
                        }
                        if(!empty($machineIdList)){
                            // get subreason ids
                            $subReasonIds = $this->downtimeSubreason->getSubreasonIdByReasonId(Config::get('global_vars.available_hrs_downtime_reasons'));
                            foreach ($machineIdList as $key => $value) {
                                $temp = [];
                                // get daily entry machine id
                                $dailyEntryMachineIds = $this->dailyEntryMachine->getIdByMachineIdAndDailyEntryId($input['dailyEntry'],$key);
                                
                                // get downtime details
                                $downtimeDetails = $this->dailyEntryDowntime->getDataToCalculateAvailableHrs($dailyEntryMachineIds,$subReasonIds);

                                if(!empty($downtimeDetails)){
                                    // get dailyEntryMachineIds for available downtime
                                    $downtimeDailyEntryMachineIds = $this->dailyEntryDowntime->getDailyEntryMachinIdList($dailyEntryMachineIds,$subReasonIds);
                                    // check intersection of both ids
                                    $diff = array_diff($dailyEntryMachineIds, $downtimeDailyEntryMachineIds);
                                   
                                    if(!empty($diff)){
                                        foreach ($diff as $key1 => $value1) {
                                            $temp[$value1]['id'] = $value1;
                                            $temp[$value1]['startTime'] = $shiftTiming['startDateTime'];
                                            $temp[$value1]['endTime'] = $downtimeDetails[0]['start_date_time'];
                                        }
                                    }
                                    // while loop for downtime details
                                    $j = 0;
                                    $m = 0;
                                    while ($j < count($downtimeDetails)) {
                                        $m = $j + 1;
                                        if(array_key_exists($downtimeDetails[$j]['daily_entry_machine_id'],$temp)){
                                            // check for other entries to  get end time
                                            if($m < count($downtimeDetails)){
                                                while ($m < count($downtimeDetails)) {
                                                    $t = $downtimeDetails[$m];
                                                    if(array_key_exists($t['daily_entry_machine_id'],$temp)){

                                                    }else{
                                                        $temp[$downtimeDetails[$j]['daily_entry_machine_id']]['endTime'] = $t['start_date_time'];
                                                    }
                                                    $m++;
                                                }
                                            }
                                            /*$temp[$downtimeDetails[$j]['daily_entry_machine_id']]['endTime'] = $downtimeDetails[$j]['end_date_time'];*/
                                        }else{
                                            $temp[$downtimeDetails[$j]['daily_entry_machine_id']]['id'] = $downtimeDetails[$j]['daily_entry_machine_id'];
                                            $temp[$downtimeDetails[$j]['daily_entry_machine_id']]['startTime'] = $downtimeDetails[$j]['start_date_time'];
                                            $temp[$downtimeDetails[$j]['daily_entry_machine_id']]['endTime'] = '';
                                        }
                                        $j++;
                                    }
                                   
                                    if(!empty($temp)){
                                        foreach ($temp as $key2 => $tempArr) {
                                            $t = $tempArr;
                                            if(empty($tempArr['endTime'])){
                                                $t['endTime'] = $shiftTiming['endDateTime'];
                                            }
                                            $machineUp[$i]['id'] = $t['id'];
                                            $machineUp[$i]['available_hrs'] = Lib::getTimeBetweenTwoDateTime($t['startTime'],$t['endTime']);
                                            $i++;
                                        }
                                    }
                                    
                                }else{
                                    $up = [];
                                    $up['available_hrs'] = Lib::convertToTime($shiftHrs,0);

                                    $d = $this->dailyEntryMachine->updateAvailableHrsByMachineIdAndDailyEntryId($input['dailyEntry'],$key,$up);

                                }
                            }
                        }
                        
                        if(!empty($machineUp)){
                            $hrsUpdate = $this->dailyEntryMachine->updateDailyEntryMachine($machineUp);
                        }
                        $updateD = $this->dailyEntry->markAsComplete($input['dailyEntry']);
                        if($updateD){
                            DB::commit();
                            $response['success'] = 1;
                            unset($response['data']);
                        }else{
                            DB::rollback();
                        }
                    }else{
                        DB::commit();
                        $response['success'] = 1;
                        unset($response['data']);
                    }	
        		}else{
        			DB::rollback();
        		}
        	}else{
        		DB::rollback();
        	}
        } catch (Exception $e) {
			DB::rollback();
        	$response['data'] = "TransactionService::saveDailyEntry ".$e->getMessage();
        }
        return $response;
	}

    public function getRejection($input)
    {
        $user = $this->user;
        $finalData = [];
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            // get all defects first
            $defects = Lib::addSelect($this->defect->getAllDefectList());
            $response['defects'] = $defects;

            // get data for daily entry machine
            $dbRejections = $this->dailyEntryRejection->getRejectionByDailyEntryMachineId($input['dailyEntryMachineId']);
            if(!empty($dbRejections)){
                foreach ($dbRejections as $key => $value) {
                    $finalData[] = [
                        'id' => $value['id'],
                        'dailyEntryMachineId' => $value['daily_entry_machine_id'],
                        'defectId' => $value['defect_id'],
                        'quantity' => $value['quantity'],
                        'comment' => $value['comment'],
                    ];
                }
            }
            $response['success'] = 1;
            $response['data'] = $finalData;
            $response['dailyEntryMachineId'] = $input['dailyEntryMachineId'];
        } catch (Exception $e) {
            $response['data'] = "TransactionService::getRejection ".$e->getMessage();
        }
        return $response;
    }

    public function saveRejection($input)
    {
        $user = $this->user;
        $insertData = [];
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $dailyEntryMachineId = $input['dailyEntryMachineId'];
            $rejectionoData = json_decode($input['rejection'],true);

            DB::beginTransaction();
            // delete previous added data
            $this->dailyEntryRejection->deleteByDailyEntryMachineId($dailyEntryMachineId);
            $qty = 0;
            // insert new data
            if(!empty($rejectionoData)){
                foreach ($rejectionoData as $key => $value) {
                    $insertData[] = [
                        'daily_entry_machine_id' => $dailyEntryMachineId,
                        'defect_id' => $value['rejection'],
                        'quantity' => $value['qty'],
                        'comment' => $value['comment'],
                        'created_by_id' => $user->id,
                        'updated_by_id' => $user->id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                    $qty += $value['qty'];
                }

                if($input['addedRejection'] != $qty){
                    $response['data'] = Lang::get('messages.rejection_mismatch');
                    return $response;
                }
                $insertSucc = $this->dailyEntryRejection->saveRejection($insertData);
                if($insertSucc){
                    // update daily entry table
                    $update['updated_by_id'] = $user->id;
                    $update['updated_at'] = date("Y-m-d H:i:s");

                    // update dailyMachineEntry for total downtime
                    $update['total_rejection'] = $this->dailyEntryRejection->getTotalRejectionByDailyEntryMachineId($dailyEntryMachineId);
                    if($input['shotCounter'] != ''){
                        $update['end_short_counter'] = $input['shotCounter'];
                    }
                    if(isset($input['shotCounterTimer']) && !empty($input['shotCounterTimer'])){
                        $update['short_counter_time'] = Lib::convertDateFormat("d-m-Y H:i",$input['shotCounterTimer'],"Y-m-d H:i:s");
                    }
                    if($input['productionQuantity'] != ''){
                        $update['production_quantity'] = $input['productionQuantity'];
                    }
                    if($input['purging'] != ''){
                        $update['purging'] = $input['purging'];
                    }
                    $update['is_completed'] = $input['isCompleted'];
                    $result = $this->dailyEntryMachine->updateData($update,$dailyEntryMachineId);
                    if($result){
                        unset($update['total_rejection'],$update['end_short_counter'],$update['short_counter_time'],$update['production_quantity'],$update['purging'],$update['is_completed']);
                        $dailyEntryMachine = $this->dailyEntryMachine->getById($dailyEntryMachineId);
                        if(count($dailyEntryMachine)){
                            $updateSucc = $this->dailyEntry->updateDailyEntry($update,$dailyEntryMachine->daily_entry_id);
                            if($updateSucc){
                                $response['totalRejection'] = $dailyEntryMachine->total_rejection;
                                $response['success'] = 1;
                                unset($response['data']);
                                DB::commit();
                            }else{
                                DB::rollback();
                            }
                        }else{
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                    
                }else{
                    DB::rollback();
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = "TransactionService::saveRejection ".$e->getMessage();
        }
        return $response;
    }


    public function getDowntime($input)
    {
        $user = $this->user;
        $finalData = [];
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            // get all downtime subreasons first
            $subreasons = Lib::addSelect($this->downtimeSubreason->getDowntimeSubreasonList());
            $response['downtimeSubreason'] = $subreasons;

            // get data for datepicker
            // 1 - get shift and other details from id
            $dailyEntryMachineData = $this->dailyEntryMachine->getById($input['dailyEntryMachineId']);
            $dailyEntryData = $this->dailyEntry->getById($dailyEntryMachineData->daily_entry_id);
            $shift = $this->shift->getShiftById($dailyEntryData->shift_id);
            $shiftHrs = Lib::getShiftHrs($shift->start_time,$shift->end_time);
            $shiftTiming = Lib::getShiftStartEndTime($dailyEntryData->date,$shift->start_time,$shiftHrs);  
            $response['shiftTiming'] = Lib::formatAllowDateAndTime($shiftTiming);

            // get data for daily entry machine
            $dbDowntime = $this->dailyEntryDowntime->getDowntimeByDailyEntryMachineId($input['dailyEntryMachineId']);
            if(!empty($dbDowntime)){
                foreach ($dbDowntime as $key => $value) {
                    $finalData[] = [
                        'id' => $value['id'],
                        'dailyEntryMachineId' => $value['daily_entry_machine_id'],
                        'subreasonId' => $value['downtime_subreason_id'],
                        'startDateTime' => Lib::convertDateFormat("Y-m-d H:i:s",$value['start_date_time'],"d-m-Y H:i"),
                        'endDateTime' => Lib::convertDateFormat("Y-m-d H:i:s",$value['end_date_time'],"d-m-Y H:i"),
                        'comment' => $value['comment'],
                    ];
                }
            }
            $response['success'] = 1;
            $response['data'] = $finalData;
            $response['dailyEntryMachineId'] = $input['dailyEntryMachineId'];
        } catch (Exception $e) {
            $response['data'] = "TransactionService::getDowntime ".$e->getMessage();
        }
        return $response;
    }

    public function saveDowntime($input)
    {
        $user = $this->user;
        $insertData = [];
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $dailyEntryMachineId = $input['dailyEntryMachineId'];
            $downtimeData = json_decode($input['downtime'],true);

            DB::beginTransaction();
            // delete previous added data
            $this->dailyEntryDowntime->deleteByDailyEntryMachineId($dailyEntryMachineId);

            // insert new data
            if(!empty($downtimeData)){
                foreach ($downtimeData as $key => $value) {
                    $insertData[] = [
                        'daily_entry_machine_id' => $dailyEntryMachineId,
                        'downtime_subreason_id' => $value['subreason'],
                        'start_date_time' => Lib::convertDateFormat("d-m-Y H:i",$value['startDateTime'],"Y-m-d H:i:s"),
                        'end_date_time' => Lib::convertDateFormat("d-m-Y H:i",$value['endDateTime'],"Y-m-d H:i:s"),
                        'comment' => $value['comment'],
                        'total_time' => Lib::getDifferenceBetweenDates($value['startDateTime'],$value['endDateTime']),
                        'created_by_id' => $user->id,
                        'updated_by_id' => $user->id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                }
                $insertSucc = $this->dailyEntryDowntime->saveDowntime($insertData);
                if($insertSucc){
                    // update daily entry table
                    $update['updated_by_id'] = $user->id;
                    $update['updated_at'] = date("Y-m-d H:i:s");

                    // update dailyMachineEntry for total downtime
                    $update['total_downtime'] = $this->dailyEntryDowntime->getTotalTimeByDailyEntryMachineId($dailyEntryMachineId);
                    if($input['shotCounter'] != ''){
                        $update['end_short_counter'] = $input['shotCounter'];
                    }
                    if(isset($input['shotCounterTimer']) && !empty($input['shotCounterTimer'])){
                        $update['short_counter_time'] = Lib::convertDateFormat("d-m-Y H:i",$input['shotCounterTimer'],"Y-m-d H:i:s");
                    }
                    if($input['productionQuantity'] != ''){
                        $update['production_quantity'] = $input['productionQuantity'];
                    }
                    if($input['purging'] != ''){
                        $update['purging'] = $input['purging'];
                    }
                    $update['is_completed'] = $input['isCompleted'];
                    if($input['totalRejection'] != ''){
                        $update['total_rejection'] = $input['totalRejection'];
                    }

                    $result = $this->dailyEntryMachine->updateData($update,$dailyEntryMachineId);
                    if($result){
                        unset($update['total_downtime'],$update['end_short_counter'], $update['short_counter_time'], $update['production_quantity'],$update['purging'],$update['is_completed'],$update['total_rejection']);
                        $dailyEntryMachine = $this->dailyEntryMachine->getById($dailyEntryMachineId);
                        if(count($dailyEntryMachine)){
                            $updateSucc = $this->dailyEntry->updateDailyEntry($update,$dailyEntryMachine->daily_entry_id);
                            if($updateSucc){
                                $t = explode(":", $dailyEntryMachine->total_downtime);
                                if(!empty($t[0])){
                                    $response['totalDowntime'] = $t[0].":".$t[1];
                                }
                                $response['success'] = 1;
                                unset($response['data']);
                                DB::commit();
                            }else{
                                DB::rollback();
                            }
                        }else{
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                    
                }else{
                    DB::rollback();
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = "TransactionService::saveDowntime ".$e->getMessage();
        }
        return $response;
    }

    public function loadAllFgInvert($input)
    {
        $user = $this->user;
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $finalData = [];
            // check daily entry already exists for the given date and shift
            $checkData['unitId'] = $user->unit_id;
            $checkData['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d");
            $checkData['shift'] = $input['shift'];

            // first check record for invert table
            $invertExists = $this->invert->checkRecord($checkData);
            if(count($invertExists)){
                $machineList = $this->machine->getMachineByUnitId($user->unit_id);
                $productList = $this->product->getProductList();

                
                $insertedMachines = $this->invertDetail->getByInvertId($invertExists->id);
                $response['isCompleted'] = $invertExists->is_completed;

                if(count($insertedMachines)){
                    $response['invertId'] = $invertExists->id;
                    foreach ($insertedMachines as $key => $value) {
                        $list = [];
                        $data = [
                            'id' => $value->id,
                            'machineId' => $value->machine_id,
                            'productId' => $value->product_id,
                            'machine' => $machineList[$value->machine_id],
                            'product' => $productList[$value->product_id],
                            'productionQuantity' => $value->production_quantity,
                            'typeOfBox' => $value->box_type,
                            'typeOfPacking' => $value->type_of_packing,
                            'isCompleted' => $value->is_completed,
                            'quantityPerBox' => $value->quantity_per_box,
                            'boxReceived' => $value->box_received,
                            'quantityReceived' => $value->quantity_received,
                            'partialQuantity' => $value->partial_quantity,
                        ];

                        // get type of packing
                        if(!empty($value->box_type)){
                            $a = [
                                'productId' => $value->product_id,
                                'typeOfBox' => $value->box_type,
                            ];
                            $listData = $this->getTypeOfPacking($a);
                            if($listData['success']){
                                foreach ($listData['data'] as $key1 => $value1) {
                                    $list[$value1['id']] = $value1['typeOfPacking'];
                                }
                            }
                        } 
                        $data['typeOfPackingList'] = Lib::addSelect($list);

                        // get box type from packing matrix
                        $b = $this->packingMatrix->getTypeOfBoxByProductId($value->product_id);
                        $data['boxType'] = Lib::addSelect($this->item->getDataByIds($b));
                       // $data['typeOfPacking'] = [""=>'Select'];
                        $response['success'] = 1;
                        $finalData[] = $data;
                    }
                    $response['data'] = $finalData;
                }   
            }else{
                $alreadyExists = $this->dailyEntry->checkRecord($checkData);
                if(count($alreadyExists)){
                    if($alreadyExists->is_completed == 'Y'){
                        $machineList = $this->machine->getMachineByUnitId($user->unit_id);
                        $productList = $this->product->getProductList();

                        // get daily entry machines
                        $machines = $this->dailyEntryMachine->getDataByDailyEntryId($alreadyExists->id);
                        if(count($machines)){
                            // insert into invert table 
                            DB::beginTransaction();
                            $invertInsert = [
                                'date' => Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d"),
                                'shift_id' => $input['shift'],
                                'unit_id' => $user->unit_id,
                                'is_completed' => 'N',
                                'created_by_id' => $user->id,
                                'updated_by_id' => $user->id,
                            ];
                            $invertInsertSucc = $this->invert->saveInvert($invertInsert);
                            $response['isCompleted'] = 'N';
                            if(count($invertInsertSucc)){
                                $invertId = $invertInsertSucc->id;
                                $response['invertId'] = $invertId;
                                foreach ($machines as $key => $machine) {
                                    $insertData[] = [
                                        'invert_id' => $invertId,
                                        'product_id' => $machine->product_id,
                                        'machine_id' => $machine->machine_id,
                                        'production_quantity' => $machine->production_quantity,
                                        'created_by_id' => $user->id,
                                        'updated_by_id' => $user->id,
                                        'created_at' => date("Y-m-d H:i:s"),
                                        'updated_at' => date("Y-m-d H:i:s"),
                                    ];
                                }
                                $insertSucc = $this->invertDetail->saveInvertDetail($insertData);
                                if($insertSucc){
                                    // fetch all entries now 
                                    $insertedMachines = $this->invertDetail->getByInvertId($invertId);
                                    if(count($insertedMachines)){
                                        DB::commit();
                                        foreach ($insertedMachines as $key => $value) {
                                            $list = [];
                                            $data = [
                                                'id' => $value->id,
                                                'machineId' => $value->machine_id,
                                                'productId' => $value->product_id,
                                                'machine' => $machineList[$value->machine_id],
                                                'product' => $productList[$value->product_id],
                                                'productionQuantity' => $value->production_quantity,
                                                'typeOfBox' => $value->box_type,
                                                'typeOfPacking' => $value->type_of_packing,
                                                'typeOfBox' => $value->type_of_packing,
                                                'isCompleted' => $value->is_completed,
                                                'quantityPerBox' => $value->quantity_per_box,
                                                'boxReceived' => $value->box_received,
                                                'quantityReceived' => $value->quantity_received,
                                                'partialQuantity' => $value->partial_quantity,
                                            ];
                                            
                                            // get type of packing
                                            if(!empty($value->box_type)){
                                                $a = [
                                                    'productId' => $value->product_id,
                                                    'typeOfBox' => $value->box_type,
                                                ];
                                                $listData = $this->getTypeOfPacking($a);
                                                if($listData['success']){
                                                    foreach ($listData['data'] as $key1 => $value1) {
                                                        $list[$value1['id']] = $value1['typeOfPacking'];
                                                    }
                                                }
                                            } 
                                            $data['typeOfPackingList'] = Lib::addSelect($list);
                                            $b = $this->packingMatrix->getTypeOfBoxByProductId($value->product_id);
                                            $data['boxType'] = Lib::addSelect($this->item->getDataByIds($b));
                                            
                                            $finalData[] = $data;
                                        }
                                        $response['success'] = 1;
                                        $response['data'] = $finalData;
                                    }     
                                }
                            }else{
                                DB::rollback();
                            }
                        }else{
                            $response['data'] = Lang::get('messages.daily_entry_not_done');
                            $response['class'] = 'alert alert-danger';
                        }
                    }else{
                        $response['data'] = Lang::get('messages.daily_entry_not_done_completed');
                        $response['class'] = 'alert alert-danger';    
                    }
                }else{
                    $response['data'] = Lang::get('messages.daily_entry_not_done');
                    $response['class'] = 'alert alert-danger';
                }
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::loadAllFgInvert ".$e->getMessage();
        }
      //  Lib::pr($response); exit;
        return $response;
    }

    public function showAllFgInvert($input)
    {
        $user = $this->user;
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $finalData = [];
            // check daily entry already exists for the given date and shift
            $checkData['unitId'] = $user->unit_id;
            $checkData['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d");
            $checkData['shift'] = $input['shift'];

            // first check record for invert table
            $invertExists = $this->invert->checkRecord($checkData);
            if(count($invertExists)){
                $machineList = $this->machine->getMachineByUnitId($user->unit_id);
                $productList = $this->product->getProductList();

                $groupId = Config::get('global_vars.HARD_CODED_ID.PACKING_MATERIAL_GROUP_ID');
                $typeId = Config::get('global_vars.HARD_CODED_ID.CARTON_TYPE_ID');
                $boxType = $this->item->getItemByGroupAndType($groupId,$typeId);
                $typeOfPacking = $this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.type_of_packing"));

                $insertedMachines = $this->invertDetail->getByInvertId($invertExists->id);
                $response['isCompleted'] = $invertExists->is_completed;

                if(count($insertedMachines)){
                    $response['invertId'] = $invertExists->id;
                    foreach ($insertedMachines as $key => $value) {
                        $list = [];
                        $data = [
                            'id' => $value->id,
                            'machine' => $machineList[$value->machine_id],
                            'product' => $productList[$value->product_id],
                            'productionQuantity' => $value->production_quantity,
                            'typeOfBox' => @$boxType[$value->box_type],
                            'typeOfPacking' => @$typeOfPacking[$value->type_of_packing],
                            'isCompleted' => $value->is_completed,
                            'quantityPerBox' => $value->quantity_per_box,
                            'boxReceived' => $value->box_received,
                            'quantityReceived' => $value->quantity_received,
                            'partialQuantity' => $value->partial_quantity,
                        ];
                        $response['success'] = 1;
                        $finalData[] = $data;
                    }
                    $response['data'] = $finalData;
                } 
            }else{
                unset($response['data']);
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::showAllFgInvert ".$e->getMessage();   
        }
        return $response;
    }
    public function getQuantityPerBox($input)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            // get quantity per box from packing matrix table
            $quantityPerBox = $this->packingMatrix->getQuantityPerBox($input); 
            $response['success'] = 1;
            $response['data'] = $quantityPerBox;
        } catch (Exception $e) {
            $response['data'] = "TransactionService::getQuantityPerBox ".$e->getMessage();
        }   
        return $response;
    }

    public function saveInvertData($input)
    {
        $user = $this->user;
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            DB::beginTransaction();
            $newData = [];

            // get all ids related to invert id
            $invertDetailIds = $this->invertDetail->getIdsByInvertId($input['invert']);

            // get deleted entries
            $deletedEntries = array_diff($invertDetailIds,$input['invertDetail']);

            // get new entries
            $newEntries = array_diff($input['invertDetail'], $invertDetailIds);
          //  Lib::pr([$invertDetailIds,$input['invertDetail'],$deletedEntries,$newEntries,$input]); exit;

            // insert new data
            if(!empty($newEntries)){
                foreach ($newEntries as $key => $value) {
                    if(isset($input['isCompleted']) && !empty($input['isCompleted'])){
                        if(isset($input['isCompleted'][$value])){
                            $isDataCompleted = $input['isCompleted'][$value];
                        }else{
                            $isDataCompleted = 'N';
                        }
                    }else{
                        $isDataCompleted = 'N';
                    }
                    $d = [
                        'invert_id' => $input['invert'],
                        'machine_id' => $input['machineId'][$value],
                        'product_id' => $input['productId'][$value],
                        'production_quantity' => $input['productionQuantity'][$value],
                        'partial_quantity' => $input['partialQuantity'][$value],
                        'is_completed' => $isDataCompleted,
                        'created_by_id' => $user->id,
                        'updated_by_id' => $user->id,
                    ];
                    if(isset($input['typeOfBox'][$value])){
                        $d['box_type'] = @$input['typeOfBox'][$value];
                    }

                    if(isset($input['typeOfPacking'][$value])){
                        $d['type_of_packing'] = @$input['typeOfPacking'][$value];
                    }

                    if(isset($input['quantityPerBox'][$value])){
                        $d['quantity_per_box'] = @$input['quantityPerBox'][$value];
                    }
                        
                    if(isset($input['boxReceived'][$value])){
                        $d['box_received'] = @$input['boxReceived'][$value];
                    }
                        
                    if(isset($input['quantityReceived'][$value])){    
                        $d['quantity_received'] = @$input['quantityReceived'][$value];
                    }
                    $newData[] = $d;
                    unset($input['invertDetail'][$value]);
                    unset($input['invertDetail'][$key]);
                }
               // Lib::pr($newData); exit;
                // insert data 
                $insertData = $this->invertDetail->saveInvertDetails($newData);
            }

            // delete data
            if(!empty($deletedEntries)){
                $this->invertDetail->deletedEntriesByIds($deletedEntries);
            }
            // step 1 - form all data
            if(!empty($input['invertDetail'])){
                $details = [];
                $i = 0;
                foreach ($input['invertDetail'] as $key => $value) {
                //  $machines[$i] = new DailyEntryMachine();
                    $details[$i]['id'] = $value;
                    if(isset($input['typeOfBox'][$value])){
                        $details[$i]['box_type'] = @$input['typeOfBox'][$value];
                    }
                    if(isset($input['typeOfPacking'][$value])){
                        $details[$i]['type_of_packing'] = @$input['typeOfPacking'][$value];
                    }
                    if(isset($input['quantityPerBox'][$value])){
                        $details[$i]['quantity_per_box'] = @$input['quantityPerBox'][$value];
                    }
                    if($input['productionQuantity'][$value]){
                        $details[$i]['production_quantity'] = $input['productionQuantity'][$value];
                    }
                    if($input['partialQuantity'][$value]){
                        $details[$i]['partial_quantity'] = $input['partialQuantity'][$value];
                    }
                    if($input['boxReceived'][$value]){
                        $details[$i]['box_received'] = $input['boxReceived'][$value];
                    }
                    if($input['quantityReceived'][$value]){
                        $details[$i]['quantity_received'] = $input['quantityReceived'][$value];
                    }
                    if(isset($input['isCompleted'][$value]) && $input['isCompleted'][$value] == 'Y'){
                        $details[$i]['is_completed'] = 'Y';
                    }else{
                        $details[$i]['is_completed'] = 'N';
                    }
                    $details[$i]['updated_by_id'] = $user->id;
                    $i++;
                }
                
                // update table with relationship
                $update['updated_by_id'] = $user->id;
                $update['updated_at'] = date("Y-m-d H:i:s");
                $updateSucc = $this->invert->updateInvert($update,$input['invert']);
                if($updateSucc){
                    // update machines
                    unset($update);
                    $result = $this->invertDetail->updateInvertDetail($details);
                    if($result){
                        if($input['invertCompleted'] == 'Y'){
                            $updateD = $this->invert->markAsComplete($input['invert']);
                            if($updateD){
                                DB::commit();
                                $response['success'] = 1;
                                unset($response['data']);
                            }else{
                                DB::rollback();
                            }
                        }else{
                            DB::commit();
                            $response['success'] = 1;
                            unset($response['data']);
                        }   
                    }else{
                        DB::rollback();
                    }
                }else{
                    DB::rollback();
                }
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::saveInvertData ".$e->getMessage();
        }
        return $response;
    }

    public function getInvertDetailData($input)
    {
        $user = $this->user;
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $input['unitId'] = $user->unit_id;
        if(isset($input['date']) && !empty($input['date'])){
            $input['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],'Y-m-d');
        }
        $invertEntries = $this->invert->getInvert($input);
        $listArr = [];
        $masterDTO = new MasterDTO();
        if(count($invertEntries)){
            foreach ($invertEntries as $key => $value) {
                
                $dto = new DailyEntryDTO();
                $dto->setId($value->id);
                $dto->setShift($value->shift_id);
                $dto->setUpdatedTime(Lib::convertDateFormat("Y-m-d H:i:s",$value->updated_at,"d-m-Y H:i"));
                $dto->setDate(Lib::convertDateFormat("Y-m-d",$value->date,"d-m-Y"));

                // get total machine count
                $totalMachine = $this->invertDetail->getMachineCountByInvertId($value->id);
                $dto->setTotalMachine($totalMachine);

                $dto->setIsCompleted($value->is_completed);
                $listArr[] = $dto;
            }
        }
        $masterDTO->setListDTO($listArr);
        $masterDTO->setCount($invertEntries->currentPage());
        $invertEntries->appends(Request::except('page'))->render();
        $masterDTO->setLinks($invertEntries->render());
        return $masterDTO;
    }

    public function deleteDailyEntry($id)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            $this->dailyEntry->deleteDailyEntry($id);
            $response['success'] = 1;
        } catch (Exception $e) {
            $response['data'] = $e->getMessage();
        }
        return $response;
    }

    public function getTypeOfPacking($input)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $packingData = [];
            // get quantity per box from packing matrix table
            $typeOfPacking = $this->packingMatrix->getTypeOfPacking($input); 
            if(count($typeOfPacking)){
                // typeof packings real data
                $realData = $this->codeValue->getDataByCodeId(Config::get("global_vars.CODE_ID.type_of_packing"));
                foreach ($typeOfPacking as $key => $value) {
                    $data = [
                        'id' => $value->type_of_packing,
                        'typeOfPacking' => $realData[$value->type_of_packing],
                        'qtyPerBox' => $value->qty_per_box,
                    ];
                    $packingData[] = $data;
                }
            }
            $response['success'] = 1;
            $response['data'] = $packingData;
        } catch (Exception $e) {
            $response['data'] = "TransactionService::getTypeOfPacking ".$e->getMessage();
        }   
        return $response;
    }

    // added by supriya
    public function showDailyEntry($id)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            // check for id
            $dailyEntry = $this->dailyEntry->getById($id);
            if(count($dailyEntry)){
                $response['success'] = 1;
            } else{
                $response['data'] = Lang::get('messages.no_record');
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::showDailyEntry ".$e->getMessage();   
        }   
        return $response;
    }

    public function saveCustomerRejection($input)
    {
        $user = $this->user;        
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            DB::beginTransaction();

            $input['rejection'] = json_decode($input['rejection'],true);
            if(!empty($input['rejection'])){
                // delete previous data
                $this->rejectionInwardDetail->deleteByInwardId($input['rejectionInwardId']);
                $rejection = $input['rejection'];
                $insertData = [];

                foreach ($rejection as $key => $value) {
                    $insertData[] = [
                        'rejection_inward_id' => $input['rejectionInwardId'],
                        'color_id' => $value['color'],
                        'qty_as_per_qc' => $value['qtyAsPerQc'],
                        'qty_recieved_by_stores' => $value['qtyRecievedByStore'],
                        'is_completed' => $value['isCompleted'],
                        'created_by_id' => $user->id,
                        'updated_by_id' => $user->id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                }
                $insertSucc = $this->rejectionInwardDetail->saveRejectionInward($insertData);
                if($insertSucc){
                    // update parent table
                    $update['is_completed'] = 'Y';
                    $update['updated_by_id'] = $user->id;

                    $succ = $this->rejection->updateRejection($update,$input['rejectionInwardId']);
                    if($succ){
                        DB::commit();
                        $response['success'] = 1;
                        unset($response['data']);
                    }
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = "TransactionService::saveCustomerRejection ".$e->getMessage();   
        }
        return $response;
    }

    public function loadRejectionSlip($input)
    {
        $user = $this->user;        
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $finalData = [];
            // check rejection entry already exists for the given date and shift and source
            $checkData['unitId'] = $user->unit_id;
            $checkData['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d");
            $checkData['shift'] = $input['shift'];
            $checkData['source'] = $input['source'];
            $response['color'] = Lib::addSelect($this->color->getColorList());

            $alreadyExists = $this->rejection->checkRecord($checkData);
            if($alreadyExists){
                // get rejection detail data
                $rejectionDetails = $this->rejectionInwardDetail->getByInwardId($alreadyExists->id);
                if(count($rejectionDetails)){
                    foreach ($rejectionDetails as $key => $value) {
                        $finalData[] = [
                            'id' => $value->id,
                            'color' => $value->color_id,
                            'colorId' => $value->color_id,
                            'qtyRecievedByStore' => $value->qty_recieved_by_stores,
                            'qtyAsPerQc' => $value->qty_as_per_qc,
                            'isCompleted' => $value->is_completed,
                        ];
                    }
                }
                $response['success'] = 1;
                $response['isCompleted'] = $alreadyExists->is_completed;
                $response['rejectionInwardId'] = $alreadyExists->id;
                $response['data'] = $finalData;
            }else{
                DB::beginTransaction();
                // get all colors
                // check for source. If source is production then check for completed daily entry. 
                // if source is ccustomer then allow him to add data
                if($input['source'] == 'PROD'){
                    // check for daily entry 
                    $checkData = array_except($checkData, ['source']);
                    $dailyEntry = $this->dailyEntry->checkRecord($checkData);
                    if(count($dailyEntry)){
                        if($dailyEntry->is_completed == 'Y'){
                            $result = $this->hourlyEntry->getProductionRejection($checkData);
                            if(!empty($result)){
                                // insert into rejction inward
                                $rejectionInsert = [
                                    'date' => Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d"),
                                    'shift_id' => $input['shift'],
                                    'unit_id' => $user->unit_id,
                                    'is_completed' => 'N',
                                    'source' => $input['source'],
                                    'created_by_id' => $user->id,
                                    'updated_by_id' => $user->id,
                                ];
                                $rejectionInsertSucc = $this->rejection->saveRejection($rejectionInsert);
                                if($rejectionInsertSucc){
                                    // insert data into detail table
                                    $i = 0;
                                    $details = [];
                                    foreach ($result as $key => $value) {
                                        $details[$i] = new RejectionInwardDetail();
                                        $details[$i]['color_id'] = $value->colorId;
                                        $details[$i]['qty_as_per_qc'] = $value->rejectionKgs;
                                        $details[$i]['is_completed'] = 'N';
                                        $details[$i]['created_by_id'] = $user->id;
                                        $details[$i]['updated_by_id'] = $user->id;
                                        $i++;
                                    }

                                    $detailInsertion = $this->rejection->saveRejectionDetail($details,$rejectionInsertSucc->id);
                                    if(count($detailInsertion)){
                                        $finalData = [];
                                        // get all date related to hourly entry id 
                                        $entriedDetails = $this->rejectionInwardDetail->getByInwardId($rejectionInsertSucc->id);
                                        foreach ($entriedDetails as $key => $value) {
                                            $data = [];
                                            $data = [
                                                'id' => $value->id,
                                                'colorId' => $value->color_id,
                                                'color' => $response['color'][$value->color_id],
                                                'isCompleted' => $value->is_completed,
                                                'qtyAsPerQc' => $value->qty_as_per_qc,
                                                'qtyRecievedByStore' => $value->qty_recieved_by_stores,
                                                'averageWt' => $value->average_wt,
                                            ];
                                            $finalData[] = $data;
                                        }
                                    }
                                    $response['success'] = 1;
                                    $response['isCompleted'] = 'N';
                                    $response['rejectionInwardId'] = $rejectionInsertSucc->id;
                                    $response['data'] = $finalData;
                                    DB::commit();
                                }
                            }else{
                                $response['data'] = Lang::get('messages.no_record');
                                $response['class'] = 'alert alert-danger'; 
                            }
                        }else{
                            $response['data'] = Lang::get('messages.daily_entry_not_done_completed');
                            $response['class'] = 'alert alert-danger';    
                        }
                    }else{
                        $response['data'] = Lang::get('messages.daily_entry_not_done');
                        $response['class'] = 'alert alert-danger';
                    }

                }else{
                    // insert into rejction inward
                    $rejectionInsert = [
                        'date' => Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d"),
                        'shift_id' => $input['shift'],
                        'unit_id' => $user->unit_id,
                        'is_completed' => 'N',
                        'source' => $input['source'],
                        'created_by_id' => $user->id,
                        'updated_by_id' => $user->id,
                    ];
                    $rejectionInsertSucc = $this->rejection->saveRejection($rejectionInsert);
                    if($rejectionInsertSucc){
                        $response['success'] = 1;
                        $response['isCompleted'] = 'N';
                        $response['rejectionInwardId'] = $rejectionInsertSucc->id;
                        $response['data'] = $finalData;
                        DB::commit();
                    }
                }
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::loadRejectionSlip ".$e->getMessage();   
        }
        return $response;
    }

    public function showRejectionData($input)
    {
        $user = $this->user;
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) ,
            'class' => 'alert alert-danger',
        ];
        try {
            $checkData['unitId'] = $user->unit_id;
            $checkData['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d");
            $checkData['shift'] = $input['shift'];
            $checkData['source'] = $input['source'];
            
            $colors = Lib::addSelect($this->color->getColorList());

            $alreadyExists = $this->rejection->checkRecord($checkData);
            if($alreadyExists){
                // get rejection detail data
                $rejectionDetails = $this->rejectionInwardDetail->getByInwardId($alreadyExists->id);
                if(count($rejectionDetails)){
                    foreach ($rejectionDetails as $key => $value) {
                        $finalData[] = [
                            'id' => $value->id,
                            'color' => $colors[$value->color_id],
                            'qtyRecievedByStore' => $value->qty_recieved_by_stores,
                            'qtyAsPerQc' => $value->qty_as_per_qc,
                            'isCompleted' => $value->is_completed,
                        ];
                    }
                }
                $response['success'] = 1;
                $response['isCompleted'] = $alreadyExists->is_completed;
                $response['rejectionInwardId'] = $alreadyExists->id;
                $response['data'] = $finalData;
            }else{
                unset($response['data']);
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::showRejectionData ".$e->getMessage();
        } 
        return $response; 
    }

    public function loadHourlyEntryData($input)
    {
        $user = $this->user;
        $details = [];        
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) ,
            'class' => 'alert alert-danger',
        ];
        try {
            $checkData['unitId'] = $user->unit_id;
            $checkData['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d");
            $checkData['shift'] = $input['shift'];
            $checkData['time'] = $input['time'];
            $alreadyExists = $this->hourlyEntry->checkRecord($checkData);
            
            $shift = $this->shift->getShiftById($input['shift']);
            $shiftHrs = Lib::getShiftHrs($shift->start_time,$shift->end_time);
            $shiftTiming = Lib::getShiftStartEndTime($input['date'],$shift->start_time,$shiftHrs);  

            // check for entry exists or not
            $machineList = $this->machine->getMachineByUnitId($user->unit_id);
            $productList = $this->product->getProductList();

            if(count($alreadyExists)){
                $response['data'] = Lang::get('messages.already_entry_done');
            }else{
                if(!empty($machineList)){
                    $data = $shiftTiming;
                    $data['machineIds'] = array_keys($machineList);
                    $activePlans = $this->planningService->getPlansForDailyEntry($data); 
                    if(count($activePlans)){ 
                        DB::beginTransaction();
                        // insert data into hourly entry
                        $insertData = [
                            'unit_id' => $user->unit_id,
                            'date' => Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d"),
                            'time' => $input['time'],
                            'shift_id' => $input['shift'],
                            'created_by_id' => $user->id,
                            'updated_by_id' => $user->id,
                            'is_completed' => 'N',
                        ];

                        $insertSucc = $this->hourlyEntry->saveHourlyEntry($insertData);
                        if(count($insertSucc)){
                            $response['hourlyEntryId'] = $insertSucc->id;
                            $response['isCompleted'] = $insertSucc->is_completed;
                            // save many records at a time
                            $i = 0;
                            foreach ($activePlans as $key => $value) {
                                $details[$i] = new HourlyEntryDetail();
                                $details[$i]['machine_id'] = $value->machine_id;
                                $details[$i]['product_id'] = $value->product_id;
                                $details[$i]['created_by_id'] = $user->id;
                                $details[$i]['updated_by_id'] = $user->id;
                                $i++;
                            }

                            /* insert data in daily entry machines table */
                            $detailInsertion = $this->hourlyEntry->saveHourlyEntryDetail($details,$insertSucc->id);
                            if(count($detailInsertion)){
                                $finalData = [];
                                // get all date related to hourly entry id 
                                $entriedDetails = $this->hourlyEntryDetail->getDataByHourlyEntryId($insertSucc->id);
                                foreach ($entriedDetails as $key => $value) {
                                    $data = [];
                                    $data = [
                                        'id' => $value->id,
                                        'machineId' => $value->machine_id,
                                        'productId' => $value->product_id,
                                        'machine' => $machineList[$value->machine_id],
                                        'product' => $productList[$value->product_id],
                                        'isCompleted' => $value->is_completed,
                                        'cycleTime' => $value->cycle_time,
                                        'cavityBlock' => $value->cavity_block,
                                        'averageWt' => $value->average_wt,
                                    ];
                                    // get std wt and std cycle time
                                    $stdValues = $this->productService->getStdValues($value->product_id);
                                   
                                    // get 10% variation
                                    $data['stdWtp10'] = $stdValues['stdWt'] + ( $stdValues['stdWt'] * 0.1);
                                    $data['stdWtm10'] = $stdValues['stdWt'] - ( $stdValues['stdWt'] * 0.1);
                                    $data['stdCtp10'] = $stdValues['stdCt'] + ( $stdValues['stdCt'] * 0.1);
                                    $data['stdCtm10'] = $stdValues['stdCt'] - ( $stdValues['stdCt'] * 0.1);
                                    $data['stdCt'] = $stdValues['stdCt'];
                                    $data['stdWt'] = $stdValues['stdWt'];

                                    $finalData[] = $data;
                                }
                                $response['data'] = $finalData;
                                $response['success'] = 1;
                                DB::commit();
                            }else{
                                DB::rollback();
                            }
                        }
                    }                   
                }
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::loadHourlyEntryData ".$e->getMessage();   
        }
        return $response;
    }

    public function saveHourlyEntryData($input)
    {
        $user = $this->user;        
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL'),
            'class' => 'alert alert-danger'
        ];
        try {
            DB::beginTransaction();
            $input['hourlyEntry'] = json_decode($input['hourlyEntry'],true);
          
            if(!empty($input['hourlyEntry'])){
                
                $hourlyData = $input['hourlyEntry'];
                $updateData = [];
                $i = 0;
                foreach ($hourlyData as $key => $value) {
                    $updateData[$i]['id'] = $value['hourlyDetailId'];
                    if($value['cycleTime'] != ''){
                        $updateData[$i]['cycle_time'] = $value['cycleTime'];
                    }
                    if($value['cavityBlock'] != ''){
                        $updateData[$i]['cavity_block'] = $value['cavityBlock'];
        
                    }
                    if($value['averageWt'] != ''){
                        $updateData[$i]['average_wt'] = $value['averageWt'];
                    }

                    if(isset($value['isCompleted']) && $value['isCompleted'] == 'Y'){
                        $updateData[$i]['is_completed'] = 'Y';
                    }else{
                        $updateData[$i]['is_completed'] = 'N';
                    }
                    $updateData[$i]['updated_by_id'] = $user->id;
                    $i++;
                }
                $updateSucc = $this->hourlyEntryDetail->saveHourlyEntry($updateData);
                if($updateSucc){
                    // update parent table
                    $update['is_completed'] = $input['houryEntryCompleted'];
                    $update['updated_by_id'] = $user->id;

                    $succ = $this->hourlyEntry->updateHourlyEntry($update,$input['hourlyEntryId']);
                    if($succ){
                        DB::commit();
                        $response['success'] = 1;
                        unset($response['data']);
                    }
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['class'] = 'alert alert-danger';
            $response['data'] = "TransactionService::saveHourlyEntryData ".$e->getMessage();   
        }
        return $response;
    }

    public function getHoulyEntryData($input)
    {
        $user = $this->user;
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $input['unitId'] = $user->unit_id;
        if(isset($input['date']) && !empty($input['date'])){
            $input['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],'Y-m-d');
        }
        $hourlyEntries = $this->hourlyEntry->getHoulyEntry($input);
        $listArr = [];
        $masterDTO = new MasterDTO();
        if(count($hourlyEntries)){
            foreach ($hourlyEntries as $key => $value) {
                
                $dto = new HourlyEntryDTO();
                $dto->setId($value->id);
                $dto->setShift($value->shift_id);
                $dto->setDate(Lib::convertDateFormat("Y-m-d",$value->date,"d-m-Y"));
                $dto->setTime(Lib::convertDateFormat("H:i:s",$value->time,"H:i"));
                $dto->setIsCompleted($value->is_completed);
                if($value->date == date("Y-m-d") || $value->date == date("Y-m-d",strtotime("yesterday"))){
                    $dto->setAllowDelete('Y');
                }else{
                    $dto->setAllowDelete('N');
                }
                $listArr[] = $dto;
            }
        }
        $masterDTO->setListDTO($listArr);
        $masterDTO->setCount($hourlyEntries->currentPage());
        $hourlyEntries->appends(Request::except('page'))->render();
        $masterDTO->setLinks($hourlyEntries->render());
        return $masterDTO;
    }

    public function getHourlyEntryById($id, $isShow = 0)
    {
        $user = $this->user;        
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL'),
        ];
        try {
            // check for record exists
            $exists = $this->hourlyEntry->getById($id);
            if(count($exists)){
                // check for edit allow or not 
                if($exists->date == date("Y-m-d") || $exists->date == date("Y-m-d",strtotime("yesterday")) || $isShow == 1){

                    $response['date'] = Lib::convertDateFormat("Y-m-d",$exists->date,"d-m-Y");
                    $response['time'] = Lib::convertDateFormat("H:i:s",$exists->time,"H:i");
                    $response['shift'] = $exists->shift_id;
                    $response['shifts'] = $this->getShifts();
                    $response['hourlyEntryId'] = $exists->id;
                    $response['isCompleted'] = $exists->is_completed;
                    $finalData = [];

                    $machineList = $this->machine->getMachineByUnitId($user->unit_id);
                    $productList = $this->product->getProductList();
                    // get all date related to hourly entry id 
                    $entriedDetails = $this->hourlyEntryDetail->getDataByHourlyEntryId($exists->id);
                    foreach ($entriedDetails as $key => $value) {
                        $data = [];
                        $data = [
                            'id' => $value->id,
                            'machineId' => $value->machine_id,
                            'productId' => $value->product_id,
                            'machine' => $machineList[$value->machine_id],
                            'product' => $productList[$value->product_id],
                            'isCompleted' => $value->is_completed,
                            'cycleTime' => $value->cycle_time,
                            'cavityBlock' => $value->cavity_block,
                            'averageWt' => $value->average_wt,
                        ];

                        // get std wt and std cycle time
                        $stdValues = $this->productService->getStdValues($value->product_id);
                       
                        // get 10% variation
                        $data['stdWtp10'] = $stdValues['stdWt'] + ( $stdValues['stdWt'] * 0.1);
                        $data['stdWtm10'] = $stdValues['stdWt'] - ( $stdValues['stdWt'] * 0.1);
                        $data['stdCtp10'] = $stdValues['stdCt'] + ( $stdValues['stdCt'] * 0.1);
                        $data['stdCtm10'] = $stdValues['stdCt'] - ( $stdValues['stdCt'] * 0.1);
                        $data['stdCt'] = $stdValues['stdCt'];
                        $data['stdWt'] = $stdValues['stdWt'];

                        $finalData[] = $data;
                    }
                    $response['data'] = $finalData;
                    $response['success'] = 1;
                  //  $response['success'] = 1;
                }
                else{
                    $response['data'] = Lang::get('messages.edit_not_allowed');
                }
            }else{
                $response['data'] = Lang::get('messages.no_record');
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::getHourlyEntryById ".$e->getMessage();   
        }
        return $response;
    }

    public function deleteHourlyEntry($id)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            $this->hourlyEntry->deleteHourlyEntry($id);
            $response['success'] = 1;
        } catch (Exception $e) {
            $response['data'] = $e->getMessage();
        }
        return $response;
    }

    public function deleteRejectionEntry($id)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            $this->rejection->deleteRejectionEntry($id);
            $response['success'] = 1;
        } catch (Exception $e) {
            $response['data'] = $e->getMessage();
        }
        return $response;
    }

    public function saveProductionRejection($input)
    {
        $user = $this->user;
        $response = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            $rejection = json_decode($input['rejection'],true);
            if(!empty($rejection)){
                foreach ($rejection as $key => $value) {
                    $update = [];
                    $update = [
                        'qty_recieved_by_stores' => $value['qtyRecievedByStore'],
                        'updated_by_id' => $user->id,
                        'is_completed' => $value['isCompleted'],
                    ];

                    $updateRecord = $this->rejectionInwardDetail->updateRejectionDetail($update,$value['id']);
                }

                // update main record
                $isCompleted = $this->rejectionInwardDetail->checkInCompleteRecord($input['rejectionInwardId']);
                $up['updated_by_id'] = $user->id;
                if($isCompleted){
                    $up['is_completed'] = 'N';
                }else{
                    $up['is_completed'] = 'Y';
                }

                $updateSucc = $this->rejection->updateRejection($up,$input['rejectionInwardId']);

                $response['success'] = 1;
                unset($response['data']);
            }
        } catch (Exception $e) {
            $response['data'] = "TransactionService::saveProductionRejection ".$e->getMessage();   
        }
        return $response;
    }

    public function getRejectionDetailData($input)
    {
        $user = $this->user;
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $input['unitId'] = $user->unit_id;
        if(isset($input['date']) && !empty($input['date'])){
            $input['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],'Y-m-d');
        }
        
        $rejectionEntries = $this->rejection->getRejectionEntry($input);
        $listArr = [];
        $masterDTO = new MasterDTO();
        if(count($rejectionEntries)){
            foreach ($rejectionEntries as $key => $value) {
                
                $dto = new RejectionEntryDTO();
                $dto->setId($value->id);
                $dto->setShift($value->shift_id);
                $dto->setDate(Lib::convertDateFormat("Y-m-d",$value->date,"d-m-Y"));
                $dto->setIsCompleted($value->is_completed);
                $dto->setSource($value->source);
                
                if($value->date == date("Y-m-d") || $value->date == date("Y-m-d",strtotime("yesterday"))){
                    $dto->setAllowDelete('Y');
                }else{
                    $dto->setAllowDelete('N');
                }
                
                $listArr[] = $dto;
            }
        }
        $masterDTO->setListDTO($listArr);
        $masterDTO->setCount($rejectionEntries->currentPage());
        $rejectionEntries->appends(Request::except('page'))->render();
        $masterDTO->setLinks($rejectionEntries->render());
        return $masterDTO;
    }

        public function loadAllMachinesForView($input)
    {
        $user = $this->user;
        $finalData = [];
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            // check data already exists for the given date and shift
            $checkData['unitId'] = $user->unit_id;
            $checkData['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d");
            $checkData['shift'] = $input['shift'];
            $alreadyExists = $this->dailyEntry->checkRecord($checkData);
            $machineList = $this->machine->getMachineByUnitId($user->unit_id);
            $productList = $this->product->getProductList();
            // get shifts start time and end time
            $shift = $this->shift->getShiftById($input['shift']);
            $shiftHrs = Lib::getShiftHrs($shift->start_time,$shift->end_time);
            $shiftTiming = Lib::getShiftStartEndTime($input['date'],$shift->start_time,$shiftHrs);  
            $response['shiftTiming'] = Lib::formatAllowDateAndTime($shiftTiming);

            if(count($alreadyExists)){
                $response['isCompleted'] = $alreadyExists->is_completed;
                $response['daliyEntryId'] = $alreadyExists->id;
                // get data from daily entry
                // get all date related to daily entry id 
                $entriedMachines = $this->dailyEntryMachine->getDataByDailyEntryId($alreadyExists->id);
                foreach ($entriedMachines as $key => $value) {
                    $data = [];
                    $data = [
                        'id' => $value->id,
                        'planId' => $value->plan_id,
                        'machineId' => $value->machine_id,
                        'productId' => $value->product_id,
                        'machine' => $machineList[$value->machine_id],
                        'product' => $productList[$value->product_id],
                        'endShortCounter' => $value->end_short_counter,
                        'productionQuantity' => $value->production_quantity,
                        'purging' => $value->purging,
                        'isCompleted' => $value->is_completed,
                        'totalRejection' => $value->total_rejection,
                        'totalDowntime' => $value->total_downtime,
                        'shortCounterTime' => Lib::convertDateFormat("Y-m-d H:i:s",$value->short_counter_time,"d-m-Y H:i"),
                    ];
                    $t = explode(":", $data['totalDowntime']);
                    if(!empty($t[0])){
                        $data['totalDowntime'] = $t[0].":".$t[1];
                    }
                    $finalData[] = $data;
                }
                $response['data'] = $finalData;
                $response['success'] = 1;
            }else{
                $response['data'] = $finalData;
                $response['success'] = 1;
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = "TransactionService::loadAllMachinesForView ".$e->getMessage();
        }
      //  Lib::pr($response); exit;
        return $response;
    }
}