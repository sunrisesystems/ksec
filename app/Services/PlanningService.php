<?php namespace ksec\Services;

use Request,Config,DB,Validator,Sentinel,Lang;
use ksec\Libraries\Lib,DateTime,DateInterval;
use ksec\Machine;
use ksec\Product;
use ksec\Mold;
use ksec\Planning;
use ksec\DowntimeSubreason;
use ksec\Drawing;

class PlanningService {

    public function __construct(Machine $machine,
                                Product $product,
                                Mold $mold,
                                Planning $planning,
                                DowntimeSubreason $downtimeSubreason,
                                Drawing $drawing)
    {
        $this->machine = $machine;
        $this->product = $product;
        $this->drawing = $drawing;
        $this->mold    = $mold;
        $this->planning = $planning;
        $this->downtimeSubreason = $downtimeSubreason;
    }

    public function getAllData($plan = null)
    {
        $user = Sentinel::getUser();
        $unitId = $user->unit_id;
        $moldData = [];
        if(!empty($plan)){
            // get plan status
            $status = $plan['status'];
            if($status == 'P'){
                $data['status'] = Lib::addSelect(Config::get('global_vars.PLANNED_PLANNING_STATUS'));
            }else if($status == 'R'){
                $data['status'] = Lib::addSelect(Config::get('global_vars.RUNNING_PLANNING_STATUS'));
            }else if($status == 'SC'){
                $data['status'] = Lib::addSelect(Config::get('global_vars.SHORT_CLOSE_PLANNING_STATUS'));
            }
        }else{
            $data['status'] = Lib::addSelect(Config::get('global_vars.PLANNING_STATUS'));
        }
        $data['machine'] = Lib::addSelect($this->machine->getMachineByUnitId($unitId));
        $data['product'] = Lib::addSelect([]); 
        $mold = $this->mold->getMoldByPriorityUnitId($unitId);
        if(!empty($mold)){
            foreach ($mold as $key => $value) {
                if($value['priority'] == 'P'){
                    $p = "-[Primary]";
                }else{
                    $p = "-[Secondary]";
                }
                $moldData[$value['id']] = $value['mold_name'].$p;
            }
        }
        $data['mold'] = Lib::addSelect($moldData);
        $data['changeOverTime'] = Lib::addSelect($this->downtimeSubreason->getSubreasonByReasonId(Config::get('global_vars.CODE_ID.change_over_time')));

        return $data;
    }

    public function getSearchData()
    {
        $user = Sentinel::getUser();
        $unitId = $user->unit_id;
        $data['status'] = Lib::addSelect(Config::get('global_vars.PLANNING_STATUS'));
        $data['machine'] = Lib::addSelect($this->machine->getMachineByUnitId($unitId));
        $data['product'] = Lib::addSelect($this->product->getProductList()); 
        return $data;
    }

    public function getMachines()
    {
        $user = Sentinel::getUser();
        $unitId = $user->unit_id;
        return  $this->machine->getMachineByUnitId($unitId);
    }

    public function getMoldByProduct($productId)
    {
        $result = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            // step 1 - get product
            $product = $this->product->getProductById($productId);
            if(count($product)){
                $drawingId = $product->drawing_id;

                // step 2 - get molds based on drawing id
                $molds = $this->mold->getMoldByDrawingId($drawingId);
                $molds = Lib::addSelect($molds);
                $result['data'] = $molds;
                $result['success'] = 1;
            }else{
                $result['data'] = Lang::get("messages.invalid_product");
            }
        } catch (Exception $e) {
            $result['data'] = $e->getMessage();
        }
        return $result;
    }

    public function getProductByMold($moldId)
    {
        $result = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            // step 1 - get mold
            $mold = $this->mold->getMoldById($moldId);
            if(count($mold)){
                $drawingId = $mold->drawing_id;

                // step 2 - get products based on drawing id
                $products = $this->product->getProductListByDrawingId($drawingId);
             //   $products = Lib::addSelect($products);
                $result['data'] = $products;

                // get drawing details 
                $drawing = $this->drawing->getDrawingById($drawingId);
                $result['drawing'] = $drawing->toArray();
                $result['success'] = 1;
            }else{
                $result['data'] = Lang::get("messages.invalid_mold");
            }
        } catch (Exception $e) {
            $result['data'] = $e->getMessage();
        }
        return $result;
    }
    
    public function getPlanningForMachine($machineId)
    {
        return $this->planning->getPlanningByMachineId($machineId);
    }

    public function checkPlanDate($input)
    {
        $result = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            $rules = $this->getDateRules();
            $validation = Validator::make($input,$rules);
            if($validation->fails()){

                $result['data'] = Lib::getFirstLaravelErrorMsg($validation);
            }
            else{
                $validDate = Lib::checkForYesterdaysDate($input['date']);
                if($validDate){
                    // check for start time in table 
                    $input['date'] = Lib::convertDateFormat("d-m-Y H:i",$input['date'],"Y-m-d H:i:s");
                    $isAllowed = $this->planning->checkDateTime($input);
                    if($isAllowed){
                        $result['data'] = Lang::get("messages.plan_date_not_avaiable");
                    }else{
                        $result['success'] = 1;
                        unset($result['data']);
                    }
                }else{
                    $result['data'] = Lang::get('messages.invalid_start_date');
                }

            }
        } catch (Exception $e) {
            $result['data'] = $e->getMessage();
        }
        return $result;
    }

    public function getDateRules()
    {
        $rules = [
            'date' => 'required|date_format:d-m-Y H:i',
            'machineId' => 'required|exists:machines,id',
            'planId' => 'exists:plannings,id',
        ];
        return $rules;
    }

    public function getCalculateTimeRules()
    {
        $rules = [
            'mold_id' => 'required|exists:molds,id,status,A',
            'planning_quantity' => 'required|integer',
            'cycle_time' => 'required',
            'cavity_blocks' => 'required',
            'start_date_time' => 'required|date_format:d-m-Y H:i',
        ];
        return $rules;
    }

    public function calculateTime($input)
    {
        $result = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            $rules = $this->getCalculateTimeRules();
            $validation = Validator::make($input,$rules);
            if($validation->fails()){
                $result['data'] = Lib::getFirstLaravelErrorMsg($validation);
            }
            else{
                $notAvailableTime = $changeOverTime = 0;
                // step 1 - get no of cavities from mold
                $mold = $this->mold->getMoldById($input['mold_id']);
                $drawingId = $mold->drawing_id;
                $drawing = $this->drawing->getDrawingById($drawingId);
                $noOfCavities = $drawing->std_cavities;
               
                // devide by 3600 to get hrs ,devide by 60 to get mins
                // get in mins 
                $totalHrs = (($input['cycle_time'] / ( $noOfCavities - $input['cavity_blocks'])) * $input['planning_quantity']) / 60;
                // add not available time if provided
                if(!empty($input['not_available_time_hrs'])){
                    $notAvailableTime += $input['not_available_time_hrs'] * 60;
                }
                if(!empty($input['not_available_time_min'])){
                    $notAvailableTime += $input['not_available_time_min'];
                }

                // add change over time if provided
                if(!empty($input['change_over_time_hrs'])){
                    $changeOverTime += $input['change_over_time_hrs'] * 60;
                }
                if(!empty($input['change_over_time_min'])){
                    $changeOverTime += $input['change_over_time_min'];
                }

                // covert mins into hrs
                $totalHrs = ($totalHrs + $notAvailableTime + $changeOverTime) / 60;
                
                $whole = floor($totalHrs);      // 1
                $fraction = $totalHrs - $whole; // .25
                $minute = Lib::roundOffNumber($fraction * 60,0);
              
                //$now = new DateTime(); //current date/time
                //27-10-2015 23:30
                $splitDateTime = explode(" ", $input['start_date_time']);
                $splitDate = explode("-", $splitDateTime[0]);
                $splitTime = explode(":", $splitDateTime[1]);
                $now = new DateTime($splitDate[2]."-".$splitDate[1]."-".$splitDate[0]." ".$splitDateTime[1]); //current date/time
             
                $now->add(new DateInterval("PT".$whole."H"));
                $now->add(new DateInterval("PT".$minute."M"));
                $new_time = $now->format('d-m-Y H:i');

                $data['end_date_time'] = $new_time;
                $splitedTime = Lib::secondsToTime($totalHrs * 60);
                $data['days'] = $splitedTime['days'];
                $data['hrs'] = $splitedTime['hrs'];
                $data['min'] = Lib::roundOffNumber($splitedTime['min'],0);
                $data['totalHrs'] = Lib::roundOffNumber($totalHrs);

                $result['data'] = $data;
                $result['success'] = 1;
            }
        } catch (Exception $e) {
            $result['data'] = $e->getMessage();
        }
        return $result;
    }

    public function savePlanning($input)
    {
         $result = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            $user = Sentinel::getUser();
            $unitId = $user->unit_id;

            // check plan date 
            $data = [
                'date' => $input['start_date_time'],
                'machineId' => $input['machine_id'],
            ];

            $dateAllow = $this->checkPlanDate($data);
            if($dateAllow['success']){
                $calculatedTime = $this->calculateTime($input);
                if($calculatedTime['success']){
                    $input['end_date_time'] = $calculatedTime['data']['end_date_time'];
                    $input['time_required_days'] = $calculatedTime['data']['days'];
                    $input['time_required_hrsm'] = $calculatedTime['data']['hrs'];
                    $input['time_required_mins'] = $calculatedTime['data']['min'];
                    $input['time_required'] = $calculatedTime['data']['totalHrs'];
                }
                $insert = [
                    'machine_id' => $input['machine_id'],
                    'mold_id' => $input['mold_id'],
                    'product_id' => $input['product_id'],
                    'pending_quantity' => $input['pending_quantity'],
                    'planning_quantity' => $input['planning_quantity'],
                    'status' => $input['status'],
                    'start_date_time' => Lib::convertDateFormat("d-m-Y H:i",$input['start_date_time'],"Y-m-d H:i:s"),
                    'end_date_time' => Lib::convertDateFormat("d-m-Y H:i",$input['end_date_time'],"Y-m-d H:i:s"),
                    'cycle_time' => $input['cycle_time'],
                    'cycle_time_reason' => @$input['cycle_time_reason'],
                    'cavity_blocks' => @$input['cavity_blocks'],
                    'cavity_block_reason' => @$input['cavity_block_reason'],
                    'not_available_time' => Lib::convertToTime(@$input['not_available_time_hrs'],$input['not_available_time_min']),
                    'not_available_time_reason' => @$input['not_available_time_reason'],
                    'change_over_time_id' => @$input['change_over_time_id'],
                    'change_over_time' => Lib::convertToTime(@$input['change_over_time_hrs'],@$input['change_over_time_min']),
                    'change_over_time_reason' => @$input['change_over_time_reason'],
                    'comment' => @$input['comment'],
                    'time_required' => $input['time_required'],
                    'time_required_days' => $input['time_required_days'],
                    'time_required_hrs' => $input['time_required_hrs'],
                    'time_required_mins' => $input['time_required_mins'],
                    'unit_id' => $unitId,
                ];

                $planInsert = $this->planning->savePlanning($insert);
                if(count($planInsert)){
                    $result['success'] = 1;
                    unset($result['data']);
                }
            }else{
                $result = $dateAllow;
            }
        } catch (Exception $e) {
            $result['data'] = $e->getMessage();
        }
        return $result;
    }

    public function checkForActiveStatus($planId)
    {
        $plan = $this->planning->getPlanningById($planId);
        if(count($plan)){
            if($plan->status == 'P' || $plan->status == 'R' || $plan->status == 'SC'){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }
    public function updatePlanning($input,$id)
    {
        $result = [
            'success' => 0,
            'data' => Lang::get('messages.ERROR'),
        ];
        try {
            // get previous status
            $previousStatus = $this->planning->getStatusById($id);
            // check for running status
            if($input['status'] == array_search("Running",Config::get('global_vars.PLANNING_STATUS'))){
                $runningPlanCount = $this->planning->getRunningPlanCountByMachineId($input['machine_id']);
                if($runningPlanCount){
                    $result['data'] = Lang::get("messages.running_plan_already_exists");
                    return $result;
                }
            }
            // check plan date 
            $data = [
                'date' => $input['start_date_time'],
                'machineId' => $input['machine_id'],
                'planId' => $id,
            ];

            $isAllowed = Lib::checkWithTodaysDate($input['start_date_time']);
            if(!$isAllowed){
                $dateAllow['success'] = 1;
            }else{
                $dateAllow = $this->checkPlanDate($data);
            }
            if($dateAllow['success']){
                $calculatedTime = $this->calculateTime($input);
                if($calculatedTime['success']){
                    $input['end_date_time'] = $calculatedTime['data']['end_date_time'];
                    $input['time_required_days'] = $calculatedTime['data']['days'];
                    $input['time_required_hrsm'] = $calculatedTime['data']['hrs'];
                    $input['time_required_mins'] = $calculatedTime['data']['min'];
                    $input['time_required'] = $calculatedTime['data']['totalHrs'];
                }
                $insert = [
                    'machine_id' => $input['machine_id'],
                    'mold_id' => $input['mold_id'],
                    'product_id' => $input['product_id'],
                    'pending_quantity' => $input['pending_quantity'],
                    'planning_quantity' => $input['planning_quantity'],
                    'status' => $input['status'],
                    'start_date_time' => Lib::convertDateFormat("d-m-Y H:i",$input['start_date_time'],"Y-m-d H:i:s"),
                    'end_date_time' => Lib::convertDateFormat("d-m-Y H:i",$input['end_date_time'],"Y-m-d H:i:s"),
                    'cycle_time' => $input['cycle_time'],
                    'cycle_time_reason' => @$input['cycle_time_reason'],
                    'cavity_blocks' => @$input['cavity_blocks'],
                    'cavity_block_reason' => @$input['cavity_block_reason'],
                    'not_available_time' => Lib::convertToTime(@$input['not_available_time_hrs'],$input['not_available_time_min']),
                    'not_available_time_reason' => @$input['not_available_time_reason'],
                    'change_over_time_id' => @$input['change_over_time_id'],
                    'change_over_time' => Lib::convertToTime(@$input['change_over_time_hrs'],@$input['change_over_time_min']),
                    'change_over_time_reason' => @$input['change_over_time_reason'],
                    'comment' => @$input['comment'],
                    'time_required' => $input['time_required'],
                    'time_required_days' => $input['time_required_days'],
                    'time_required_hrs' => $input['time_required_hrs'],
                    'time_required_mins' => $input['time_required_mins'],
                    'close_date_time' => (isset($input['close_date_time']) && !empty($input['close_date_time'])) ? Lib::convertDateFormat("d-m-Y H:i",$input['close_date_time'],"Y-m-d H:i:s") : NULL,
                ];
                if($previousStatus == 'SC'){
                    $insert['close_date_time'] = NULL;
                }
                $planInsert = $this->planning->updatePlanning($insert,$id);
                if($planInsert){
                    $result['success'] = 1;
                    unset($result['data']);
                }
            }else{
                $result = $dateAllow;
            }
        } catch (Exception $e) {
            $result['data'] = $e->getMessage();
        }
        return $result;
    }

    public function getPlannings($input)
    {
        $user = Sentinel::getUser();
        $input['unitId'] = $user->unit_id; 
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        if(isset($input['startDate']) && !empty($input['startDate'])){
            $input['startDate'] = Lib::convertDateFormat("d-m-Y",$input['startDate'],"Y-m-d");
        }
        if(isset($input['endDate']) && !empty($input['endDate'])){
            $input['endDate'] = Lib::convertDateFormat("d-m-Y",$input['endDate'],"Y-m-d");
        }
        $plannings = $this->planning->getPlannings($input);
        return $plannings;
    }

    public function getPlanning($id)
    {
        $plan = $this->planning->getPlanningById($id);
        if(!empty($plan->change_over_time) && $plan->change_over_time != '00:00:00'){
            $changeOver = explode(":", $plan->change_over_time);
            $plan->change_over_time_hrs = $changeOver[0];
            $plan->change_over_time_min = $changeOver[1];
        }
        if(!empty($plan->not_available_time) && $plan->not_available_time != '00:00:00'){
            $noTime = explode(":", $plan->not_available_time);
            $plan->not_available_time_hrs = $noTime[0];
            $plan->not_available_time_min = $noTime[1];
        }
        //check for edit available or not
        //start time if less than current date time then disable it
        $plan->start_date_time = Lib::convertDateFormat("Y-m-d H:i:s",$plan->start_date_time,"d-m-Y H:i");
        $plan->end_date_time = Lib::convertDateFormat("Y-m-d H:i:s",$plan->end_date_time,"d-m-Y H:i");
        $isAllowed = Lib::checkWithTodaysDate($plan->start_date_time);
        if($isAllowed){
            $plan->editAllow = 'Y';
        }else{
            $plan->editAllow = 'N';
        }
         // now get number of planned running for the machine
        $runningPlanCount = $this->planning->getRunningPlanCountByMachineId($plan->machine_id);
        $plan->running_plan_count = $runningPlanCount;
        return $plan;
    }

    public function getPlansForDailyEntry($input)
    {
        $dates[] = $input['startDateTime'];
        $dates[] = $input['endDateTime'];
        return $this->planning->getPlansForDailyEntry($input,$dates);
    }

    public function getActiveMachineListUnitWise($data)
    {
        
    }
}
