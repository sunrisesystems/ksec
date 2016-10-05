<?php namespace ksec\Services;

use Request,Config,DB,Validator;
use ksec\Libraries\Lib;
use ksec\Profile as Profile;
use ksec\Employee as Employee;
use ksec\EmpType as EmpType;
use ksec\UserRole as UserRole;
use ksec\Department as Department;
use ksec\City as City;
use Sentinel,Lang;
use ksec\Dto\EmployeeDTO;
use ksec\Dto\MasterDTO;

class EmployeeService {

    public function __construct(Profile $profile,
                                Employee $employee,
                                UserRole $userRole,
                                EmpType $empType,
                                Department $department,
                                City $city)
    {
        $this->profile = $profile;
        $this->employee = $employee;
        $this->userRole = $userRole;
        $this->empType = $empType;
        $this->department = $department;
        $this->city = $city;
	}   

	public function getAllData()
 	{
        $data['profile'] = Lib::addSelect($this->profile->getRoleList());
        $data['manager'] = Lib::addSelect($this->employee->getActiveManagerEmployeeList());
        $data['department'] = Lib::addSelect($this->department->getActiveDepartmentList());
        $data['teamLead'] = Lib::addSelect($this->employee->getActiveTeamLeadEmployeeList());
        $data['empType'] = Lib::addSelect($this->empType->getActiveEmpTypeList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['allowLogin'] = Lib::addSelect(Config::get('global_vars.ALLOW_LOGIN'));
        $data['city'] = Lib::addSelect($this->city->getAllCities());

        return $data;
 	}

    public function getAllDataWithInactive()
    {
        $data['profile'] = Lib::addSelect($this->profile->getRoleList());
        $data['manager'] = Lib::addSelect($this->employee->getManagerEmployeeList());
        $data['department'] = Lib::addSelect($this->department->getAllDepartmentList());
        $data['teamLead'] = Lib::addSelect($this->employee->getTeamLeadEmployeeList());
        $data['empType'] = Lib::addSelect($this->empType->getEmpTypeList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['allowLogin'] = Lib::addSelect(Config::get('global_vars.ALLOW_LOGIN'));
        $data['city'] = Lib::addSelect($this->city->getAllCities());
        return $data;
    }
    public function getAllEmployess($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        if(isset($input['profile']) && !empty($input['profile'])){
            // get user id of having given role
            $userIds = $this->userRole->getUserIdByRoleId($input['profile']);
            if(!empty($userIds)){
                $input['userId'] = $userIds;
            }else{
                $input['userId'] = [-1];
            }
        }
        $employees = $this->employee->getEmployees($input);
        $listArr = [];
        $masterDTO = new MasterDTO();

        if(count($employees)){
            foreach ($employees as $key => $value) {
                $dto = new EmployeeDTO();
                $dto->setId($value->id);
                $dto->setName($value->emp_name);
                $dto->setEmpCode($value->emp_code);
                $dto->setSystemId($value->system_id);
                $dto->setEmpType($value->emp_type_id);
                $dto->setLastLogin(Lib::convertDateFormat("Y-m-d H:i:s",$value->last_login,"d-m-Y H:i:s"));
                $dto->setProfile($value->userRole->role_id);
                $dto->setDepartment($value->department_id);
                $dto->setAllowLogin($value->allow_login);
                $dto->setStatus($value->status);
                $listArr[] = $dto;
            }
        }
        $masterDTO->setListDTO($listArr);
        $masterDTO->setCount($employees->currentPage());
        $employees->appends(Request::except('page'))->render();
        $masterDTO->setLinks($employees->render());
        return $masterDTO;
    }

    public function saveEmployee($input)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $input = Lib::trimInput($input);
            DB::beginTransaction();
            $empInsert = [
                'emp_code' => $input['empCode'],
                'system_id' => $input['systemId'],
                'emp_name' => $input['empName'],
                'email' => $input['email'],
                'emp_type_id' => $input['empType'],
                'department_id' => $input['department'],
                'mobile' => $input['mobile'],
                'email' => $input['email'],
                'allow_login' => $input['allowLogin'],
                'password' => $input['password'],
                'city_id' => $input['city'],
                'status' => $input['status'],
            ];
            if(!empty($input['teamleadId'])){
                $empInsert['tl_id'] = $input['teamleadId'];
            }

            if(!empty($input['managerId'])){
                $empInsert['manager_id'] = $input['managerId'];
            }


            $addedEmp = Sentinel::registerAndActivate($empInsert);

            if(count($addedEmp)){
                $emp = Sentinel::findById($addedEmp->id);

                $role = Sentinel::findRoleById($input['profile']);
                $role->users()->attach($emp);

                DB::commit();
                $response['success'] = 1;
                unset($response['data']);
            }else{
                DB::rollback();
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = "EmployeeService::saveEmployee ".$e->getMessage();   
        }
        return $response;
    }

    public function getEmployeeById($id)
    {
        return $this->employee->findById($id);
    }

    public function updateEmployee($input,$id)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            // get previous data
            $prevEmp = $this->employee->findById($id);

            $input = Lib::trimInput($input);
            DB::beginTransaction();
            $employee = Sentinel::findById($id);
            
            $empUpdate = [
                'emp_code' => $input['empCode'],
                'system_id' => $input['systemId'],
                'emp_name' => $input['empName'],
                'email' => $input['email'],
                'emp_type_id' => $input['empType'],
                'department_id' => $input['department'],
                'mobile' => $input['mobile'],
                'email' => $input['email'],
                'city_id' => $input['city'],
                'allow_login' => $input['allowLogin'],
                'status' => $input['status'],
            ];

            // update user 
            $updateUserSucc = Sentinel::update($employee, $empUpdate);

            if(count($updateUserSucc)){
                $prevRole = $prevEmp->userRole->role_id;

                if($prevRole != $input['profile']){
                     // remove previous role
                    $profile = Sentinel::findRoleById($prevRole);
                    $profile->users()->detach($user);

                    // add new role
                    $profile = Sentinel::findRoleById($input['profile']);
                    $profile->users()->attach($user);                    
                }
               

                DB::commit();
                $response['success'] = 1;
                unset($response['data']);
            }else{
                DB::rollback();
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = "UserService::saveUser ".$e->getMessage();   
        }
        return $response;
    }

    /*public function resetPassword($input)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {

            $user = Sentinel::findById($input['userId']);
            
            $userUpdate = [
                'password' => $input['password'],
            ];

            // update user 
            $updateUserSucc = Sentinel::update($user, $userUpdate);
            if($updateUserSucc){
                $response['success'] = 1;
                $response['data'] = Lang::get('messages.pwd_reset_succ');
            }
        } catch (Exception $e) {
            $response['data'] = "UserService::saveUser ".$e->getMessage();
        }
        return $response;
    }*/
}