<?php 
namespace ksec\Services;

use Lib,Config,Lang,Sentinel,DB,Request;
use ksec\Employee;
use ksec\Process;
use ksec\CodeValue;
use ksec\CallType;
use ksec\SqHead;
use ksec\SqFatal;
use ksec\SqQualityVoice;
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
                                SqQualityService $sqQualityService,
                                SqQualityVoice $sqQualityVoice)
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
        $this->sqQualityVoice = $sqQualityVoice;
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

        $tmData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.tm'));
        if($tmData['success']){
            $data['tmData'] = $tmData['data'];
        }
        $cmData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.communication'));
        if($cmData['success']){
            $data['cmData'] = $cmData['data'];
        }
        $chpData= $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.chp'));
        if($chpData['success']){
            $data['chpData'] = $chpData['data'];
        }
        $poaData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.pao'));
        if($poaData['success']){
            $data['poaData'] = $poaData['data'];
        }
        $delighterData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.delighter'));
        if($delighterData['success']){
            $data['delighterData'] = $delighterData['data'];
        }
        $suData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.su'));
        if($suData['success']){
            $data['suData'] = $suData['data'];
        }
        $sctData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.sct'));
        if($sctData['success']){
            $data['sctData'] = $sctData['data'];
        }
        $ocrData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.ocr'));
        if($ocrData['success']){
            $data['ocrData'] = $ocrData['data'];
        }

        $data['otherQuality'] = Lib::addSelect(Config::get('global_vars.OTHER_QUALITY'));
        $data['osat'] = Lib::addSelect(Config::get('global_vars.OSAT'));
        
        return $data;
        //Lib::pr($data); exit;
    }

    public function getQualityScoreMatrix()
    {
        $tmData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.tm'));
        if($tmData['success']){
            $data['tmData'] = $tmData['data'];
        }
        $cmData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.communication'));
        if($cmData['success']){
            $data['cmData'] = $cmData['data'];
        }
        $chpData= $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.chp'));
        if($chpData['success']){
            $data['chpData'] = $chpData['data'];
        }
        $poaData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.pao'));
        if($poaData['success']){
            $data['poaData'] = $poaData['data'];
        }
        $delighterData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.delighter'));
        if($delighterData['success']){
            $data['delighterData'] = $delighterData['data'];
        }
        $suData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.su'));
        if($suData['success']){
            $data['suData'] = $suData['data'];
        }
        $sctData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.sct'));
        if($sctData['success']){
            $data['sctData'] = $sctData['data'];
        }
        $ocrData = $this->sqQualityService->getQualityParameters($this->formName,Config::get('global_vars.quality.ocr'));
        if($ocrData['success']){
            $data['ocrData'] = $ocrData['data'];
        }

        $data['otherQuality'] = Lib::addSelect(Config::get('global_vars.OTHER_QUALITY'));
        $data['osat'] = Lib::addSelect(Config::get('global_vars.OSAT'));

        return $data;
    }

    public function saveVoiceData($input)
    {
        
        try {
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
                'form_id' => Config::get("global_vars.FORM_ID.VOICE"),
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

            if($input['appreciation'] == 'Yes'){
                $appreciation = 'Y';
            }else{
                $appreciation = 'N';
            }

            // calculate quality details
            $qualityMax = $input['tmMax'] + $input['cmMax'] + $input['chpMax'] + $input['poaMax'] + $input['delighterMax'] + $input['suMax'] + $input['sctMax'] + $input['ocrMax'];

            $qualityAch = $input['tmAch'] + $input['cmAch'] + $input['chpAch'] + $input['poaAch'] + $input['delighterAch'] + $input['suAch'] + $input['sctAch'] + $input['ocrAch'];

            $headInsert['quality_max'] = $qualityMax;
            $headInsert['quality_ach'] = $qualityAch;

            if($qualityAch > 0 && $qualityMax > 0){
                $qualityPer = ($qualityAch / $qualityMax) * 100;
            }else{
                $qualityPer = 0;
            }
            $headInsert['quality_per'] = $qualityPer;

            $headInsert['appr'] = $appreciation;

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

                // save quality record
                $qualityInsert = [
                    'sq_head_id' => $headInsertResult->id,
                    'tm' => $input['tm'],
                    'tm_max' => $input['tmMax'],
                    'tm_ach' => $input['tmAch'],
                    'comm' => $input['cm'],
                    'comm_max' => $input['cmMax'],
                    'comm_ach' => $input['cmAch'],
                    'chp' => $input['chp'],
                    'chp_max' => $input['chpMax'],
                    'chp_ach' => $input['chpAch'],
                    'pao' => $input['poa'],
                    'pao_max' => $input['poaMax'],
                    'pao_ach' => $input['poaAch'],
                    'du' => $input['delighter'],
                    'du_max' => $input['delighterMax'],
                    'du_ach' => $input['delighterAch'],
                    'su' => $input['su'],
                    'su_max' => $input['suMax'],
                    'su_ach' => $input['suAch'],
                    'cct' => $input['sct'],
                    'cct_max' => $input['sctMax'],
                    'cct_ach' => $input['sctAch'],
                    'ocr' => $input['ocr'],
                    'ocr_max' => $input['ocrMax'],
                    'ocr_ach' => $input['ocrAch'],
                    'pg' => $input['pg'],
                    'osat' => $input['osat'],
                    'rsat' => "Yes",
                    'appr' => $input['appreciation'],
                    'comment1' => $input['qualityComment1'],
                    'comment2' => $input['qualityComment2'],
                ];

                $qualityInsertResult = $this->sqQualityVoice->saveQualityVoice($qualityInsert);
                if(! count($qualityInsertResult)){
                    DB::rollback();
                    return $response;
                }
                DB::commit();
                $response = [
                    'success' => 1,
                ];
                
            }
        //    return $response;
        } catch (Exception $e) {
            DB::rollback();
        }finally{
            return $response;
        }
    }

    public function getVoiceSqHead($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $input['form_id'] = Config::get('global_vars.FORM_ID.VOICE');

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

    public function getVoiceById($voiceId)
    {
        return $this->sqHead->getSqHeadById($voiceId);
    }

    public function updateVoiceData($input,$id)
    {

        try {
            $response = [
                'success' => 0,
                'data' => Lang::get('messages.PROCESS_FAIL'),
            ];

            DB::beginTransaction();

            $loggedInUser = $this->user;

            $updateSqHead = [
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
                'updated_by' => $loggedInUser->id,
            ];

            if(!empty($input['fatalReason1']) || !empty($input['fatalReason2'])){
                $updateSqHead['fatal'] = 'Y';
            }else{
                $updateSqHead['fatal'] = 'N';
            }

            if($input['knowledge'] == 'No' || $input['securityVerification'] == 'No' || $input['callBackSeverity'] == 'No' || $input['adherenceOther'] == 'No' ){
                $updateSqHead ['adherence'] = 'N';
            }else{
                $updateSqHead ['adherence'] = 'Y';
            }

            if($input['appreciation'] == 'Yes'){
                $appreciation = 'Y';
            }else{
                $appreciation = 'N';
            }

            // calculate quality details
            $qualityMax = $input['tmMax'] + $input['cmMax'] + $input['chpMax'] + $input['poaMax'] + $input['delighterMax'] + $input['suMax'] + $input['sctMax'] + $input['ocrMax'];

            $qualityAch = $input['tmAch'] + $input['cmAch'] + $input['chpAch'] + $input['poaAch'] + $input['delighterAch'] + $input['suAch'] + $input['sctAch'] + $input['ocrAch'];

            $updateSqHead['quality_max'] = $qualityMax;
            $updateSqHead['quality_ach'] = $qualityAch;

            if($qualityAch > 0 && $qualityMax > 0){
                $qualityPer = ($qualityAch / $qualityMax) * 100;
            }else{
                $qualityPer = 0;
            }
            $updateSqHead['quality_per'] = $qualityPer;

            $updateSqHead['appr'] = $appreciation;

            $updateSqHeadResult = $this->sqHead->updateSqHead($updateSqHead,$id);
            if($updateSqHeadResult){
                // check for fatal now
                if(!empty($input['fatalReason1']) || !empty($input['fatalReason2']) || !empty($input['fatalComment'])){
                    // fatal insert
                    $fatalExists = [
                        'sq_head_id' => $id,
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

                    $fatalInsertResult = $this->sqFatal->saveOrUpdateFatal($fatalInsert,$fatalExists);
                    if(! count($fatalInsertResult)){
                        DB::rollback();
                        return $response;
                    }
                }

                // update sq adherence
                $adherenceUpdate = [
                    'aik' => $input['knowledge'],
                    'sv' => $input['securityVerification'],
                    'cbs' => $input['callBackSeverity'],
                    'other' => $input['adherenceOther'],
                    'comment' => $input['adherenceComment'],
                ];

                $adherenceUpdateResult = $this->sqAdherence->updateAdherence($adherenceUpdate,$id);
                if(! count($adherenceUpdateResult)){
                    DB::rollback();
                    return $response;
                }

                // save quality record
                $qualityUpdate = [
                    'tm' => $input['tm'],
                    'tm_max' => $input['tmMax'],
                    'tm_ach' => $input['tmAch'],
                    'comm' => $input['cm'],
                    'comm_max' => $input['cmMax'],
                    'comm_ach' => $input['cmAch'],
                    'chp' => $input['chp'],
                    'chp_max' => $input['chpMax'],
                    'chp_ach' => $input['chpAch'],
                    'pao' => $input['poa'],
                    'pao_max' => $input['poaMax'],
                    'pao_ach' => $input['poaAch'],
                    'du' => $input['delighter'],
                    'du_max' => $input['delighterMax'],
                    'du_ach' => $input['delighterAch'],
                    'su' => $input['su'],
                    'su_max' => $input['suMax'],
                    'su_ach' => $input['suAch'],
                    'cct' => $input['sct'],
                    'cct_max' => $input['sctMax'],
                    'cct_ach' => $input['sctAch'],
                    'ocr' => $input['ocr'],
                    'ocr_max' => $input['ocrMax'],
                    'ocr_ach' => $input['ocrAch'],
                    'pg' => $input['pg'],
                    'osat' => $input['osat'],
                    'rsat' => "Yes",
                    'appr' => $input['appreciation'],
                    'comment1' => $input['qualityComment1'],
                    'comment2' => $input['qualityComment2'],
                ];

                $qualityUpdateResult = $this->sqQualityVoice->updateQualityVoice($qualityUpdate,$id);
                if(! count($qualityUpdateResult)){
                    DB::rollback();
                    return $response;
                }
                DB::commit();
                $response = [
                    'success' => 1,
                ];                                

            }else{
                DB::rollback();
            }
        } catch (Exception $e) {
            
        }finally{
            return $response;
        }
    }

    
}