<?php 
namespace ksec\Services;

use Lib,Config,Lang,Sentinel,DB,Request;
use ksec\Employee;
use ksec\Process;
use ksec\CodeValue;
use ksec\CallType;
use ksec\SqHead;
use ksec\SqFatal;
use ksec\SqAdherence;
use ksec\Dto\SqHeadDTO;
use ksec\Dto\MasterDTO;
use ksec\Services\SqQualityService;

class VoiceService {

    public function __construct(Employee $employee,
                                Process $process,
                                CodeValue $codeValue,
                                CallType $callType,
                                SqHead $sqHead,
                                SqFatal $sqFatal,
                                SqAdherence $sqAdherence,
                                SqQualityService $sqQualityService)
    {
        $this->employee = $employee;
        $this->process = $process;
        $this->codeValue = $codeValue;
        $this->callType = $callType; 
        $this->user = Sentinel::getUser();
        $this->sqHead = $sqHead;
        $this->sqFatal = $sqFatal;
        $this->sqAdherence = $sqAdherence;
        $this->sqQualityService = $sqQualityService;
        $this->formName = 'sq_quality_voice';
	}

    public function getAllActiveData()
    {
        $data['process'] = Lib::addSelect($this->process->getAllActiveProcessList());
        $data['manager'] = Lib::addSelect($this->employee->getActiveManagerEmployeeList());
        $data['agent'] = Lib::addSelect($this->employee->getActiveAgentEmployeeList());
        $data['teamLead'] = Lib::addSelect($this->employee->getActiveTeamLeadEmployeeList());
        $data['category'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.HARD_CODED_ID.employeeCategory")));
        $data['callDuration'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.HARD_CODED_ID.callDuration")));
        $data['callType'] = Lib::addSelect($this->callType->getActiveCallTypeList());
        $data['subCallType'] = Lib::addSelect([]);
        $data['fatalReason'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.HARD_CODED_ID.fatalReason")));
        $data['adherence'] = Lib::addSelect(Config::get('global_vars.ADHERENCE'));

        $data['tmData'] = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.tm'));
        $data['cmData'] = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.communication'));
        $data['chpData'] = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.chp'));
        $data['paoData'] = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.pao'));
        $data['delighterData'] = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.delighter'));
        $data['suData'] = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.su'));
        $data['sctData'] = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.sct'));
        $data['ocrData'] = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.ocr'));

        return $data;
        //Lib::pr($data); exit;
    }

    public function saveVoiceData($input)
    {
        //try {
            $response = [
                'success' => 0,
                'data' => Lang::get('messages.PROCESS_FAIL'),
            ];

            DB::beginTransaction();

            $loggedInUser = $this->user;

            // insert array for sq_head table
            $headInsert = [
                'trdate' => Lib::convertDateFormat("d-M-Y",$input['date'],"Y-m-d"),
                'process_id' => $input['process'],
                'agent_id' => $input['agent'],
                'tl_id' => $input['teamLead'],
                'manager_id' => $input['manager'],
                'cat_id' => $input['category'],
                'client_id' => $input['clientId'],
                'call_id' => $input['callId'],
                'duration_id' => $input['duration'],
                'calltype_id' => $input['callType'],
                'subcalltype_id' => $input['subCallType'],
                'created_by' => $loggedInUser->id,
                'updated_by' => $loggedInUser->id,
                'form_id' => Config::get("global_vars.FORM_ID.VOCIE"),
            ];

            if(!empty($input['fatalReason1']) || !empty($input['fatalReason2'])){
                $headInsert['fatal'] = 'Y';
            }else{
                $headInsert['fatal'] = 'N';
            }

            if($input['knowledge'] == 'No' || $input['securityVerification'] == 'No' || $input['callBackSeverity'] == 'No' || $input['adherenceOther'] == 'No' ){
                $headInsert ['adherence'] = 'N';
            }else{
                $headInsert ['adherence'] = 'Y';
            }
            // insert data into sq_head table
            $headInsertResult = $this->sqHead->saveSqHead($headInsert);
            if(count($headInsertResult)){

                // now check for fatal and insert data
                if(!empty($input['fatalReason1']) || !empty($input['fatalReason2']) || !empty($input['fatalComment'])){
                    // fatal insert
                    $fatalInsert = [
                        'sq_head_id' => $headInsertResult->id,
                    ];
                    if(!empty($input['fatalReason1'])){
                        $fatalInsert['reason1_id'] = $input['fatalReason1'];
                    }

                    if(!empty($input['fatalReason2'])){
                        $fatalInsert['reason2_id'] = $input['fatalReason2'];
                    }

                    if(!empty($input['fatalComment'])){
                        $fatalInsert['comment'] = $input['fatalComment'];
                    }

                    $fatalInsertResult = $this->sqFatal->saveFatal($fatalInsert);
                    if(! count($fatalInsertResult)){
                        DB::rollback();
                        return $response;
                    }
                }

                $adherenceInsert = [
                    'sq_head_id' => $headInsertResult->id,
                    'aik' => $input['knowledge'],
                    'sv' => $input['securityVerification'],
                    'cbs' => $input['callBackSeverity'],
                    'other' => $input['adherenceOther'],
                    'comment' => $input['adherenceComment'],
                ];

                $adherenceInsertResult = $this->sqAdherence->saveAdherence($adherenceInsert);
                if(! count($adherenceInsertResult)){
                    DB::rollback();
                    return $response;
                }
                DB::commit();
                $response = [
                    'success' => 1,
                ];
                
            }
            return $response;
        /*} catch (Exception $e) {
            DB::rollback();
        }finally{
            return $response;
        }*/
    }

    public function getVoiceSqHead($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $input['form_id'] = Config::get('global_vars.FORM_ID.VOCIE');

        $sqHeadData = $this->sqHead->getSqHeadByFormId($input);
        $listArr = [];
        $masterDTO = new MasterDTO();

        if(count($sqHeadData)){
            foreach ($sqHeadData as $key => $value) {
                $dto = new SqHeadDTO();
                $dto->setId($value->id);
                $dto->setDate(Lib::convertDateFormat("Y-m-d",$value->trdate,"d-M-Y"));
                $dto->setProcess($value->process_id);
                $dto->setAgent($value->agent_id);
                $dto->setManager($value->manager_id);
                $dto->setTl($value->tl_id);
                $dto->setAgentCategory($value->cat_id);
                $dto->setFatal($value->fatal);
                $dto->setAdherence($value->adherence);
                $dto->setQualityPer($value->quality_per);
                $listArr[] = $dto;
            }
        }
        $masterDTO->setListDTO($listArr);
        $masterDTO->setCount($sqHeadData->currentPage());
        $sqHeadData->appends(Request::except('page'))->render();
        $masterDTO->setLinks($sqHeadData->render());
        return $masterDTO;
    }
}