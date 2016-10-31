<?php

namespace ksec\Services;


use Lib,Config,Lang,Sentinel,DB,Request;
use ksec\Employee;
use ksec\Process;
use ksec\SqHead;
use ksec\SqFatal;
use ksec\SqQualityVoice;
use ksec\SqAdherence;
use ksec\SqForm;

class AuditService
{
	
	function __construct(Employee $employee,
                        Process $process,
                       	SqHead $sqHead,
                        SqFatal $sqFatal,
                        SqAdherence $sqAdherence,
                       	SqForm $sqForm,
                        SqQualityVoice $sqQualityVoice)
	{
		$this->employee = $employee;
        $this->process = $process;
        $this->user = Sentinel::getUser();
        $this->sqHead = $sqHead;
        $this->sqFatal = $sqFatal;
        $this->sqAdherence = $sqAdherence;
        $this->sqForm = $sqForm;
        $this->sqQualityVoice = $sqQualityVoice;
	}

	public function getIndexData()
	{
		$data['process'] = $this->process->getAllActiveProcessList();
        $data['manager'] = $this->employee->getActiveManagerEmployeeList();
        $data['agent'] = $this->employee->getActiveAgentEmployeeList();
        $data['teamLead'] = $this->employee->getActiveTeamLeadEmployeeList();
        $data['sqForm'] = $this->sqForm->getFormList();
        return $data;
	}

    public function getAuditData($input)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get("messages.PROCESS_FAIL"),
            ];
            $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");

            $auditData = $this->sqHead->getAuditData($input);
            $response = [
                'success' => 1,
                'data' => $auditData,
            ];
            
        } catch (Exception $e) {
            
        }finally{
            return $response;
        }
    }
}