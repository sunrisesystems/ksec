<?php 
namespace ksec\Services;

use Lib,Config,Lang;
use ksec\Employee;
use ksec\Process;
use ksec\CodeValue;

class VoiceService {

    public function __construct(Employee $employee,
                                Process $process,
                                CodeValue $codeValue)
    {
        $this->employee = $employee;
        $this->process = $process;
        $this->codeValue = $codeValue;
	}

    public function getAllActiveData()
    {
        $data['process'] = Lib::addSelect($this->process->getAllActiveProcessList());
        $data['manager'] = Lib::addSelect($this->employee->getActiveManagerEmployeeList());
        $data['agent'] = Lib::addSelect($this->employee->getActiveAgentEmployeeList());
        $data['teamLead'] = Lib::addSelect($this->employee->getActiveTeamLeadEmployeeList());
        $data['category'] = Lib::addSelect($this->codeValue->getDataByCodeId(Config::get("global_vars.HARD_CODED_ID.employeeCategory")));
    }
}