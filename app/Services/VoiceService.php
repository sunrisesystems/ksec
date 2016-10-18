<?php 
namespace ksec\Services;

use Lib,Config,Lang,Sentinel,DB;
use ksec\Employee;
use ksec\Process;
use ksec\CodeValue;
use ksec\CallType;
use ksec\SqHead;

class VoiceService {

    public function __construct(Employee $employee,
                                Process $process,
                                CodeValue $codeValue,
                                CallType $callType,
                                SqHead $sqHead)
    {
        $this->employee = $employee;
        $this->process = $process;
        $this->codeValue = $codeValue;
        $this->callType = $callType; 
        $this->user = Sentinel::getUser();
        $this->sqHead = $sqHead;
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
            ];

            // insert data into sq_head table
            $headInsertResult = $this->sqHead->saveSqHead($headInsert);
            if(count($headInsertResult)){
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
}