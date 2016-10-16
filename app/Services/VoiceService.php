<?php 
namespace ksec\Services;

use Lib,Config,Lang;
use ksec\Employee;
use ksec\Process;
use ksec\CodeValue;
use ksec\CallType;

class VoiceService {

    public function __construct(Employee $employee,
                                Process $process,
                                CodeValue $codeValue,
                                CallType $callType)
    {
        $this->employee = $employee;
        $this->process = $process;
        $this->codeValue = $codeValue;
        $this->callType = $callType; 
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
}