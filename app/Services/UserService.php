<?php namespace ksec\Services;

use Request,Config,DB,Validator;
use ksec\Libraries\Lib;
use ksec\Unit as Unit;
use ksec\Role as Role;
use ksec\User as User;
use ksec\UserRole as UserRole;
use Sentinel,Lang;
use ksec\Dto\UserDTO;
use ksec\Dto\MasterDTO;

class UserService {

    public function __construct(Unit $unit,
                                Role $role,
                                User $user,
                                UserRole $userRole)
    {
    	$this->unit = $unit;
        $this->role = $role;
        $this->user = $user;
        $this->userRole = $userRole;
	}   

	public function getAllData()
 	{
 		$data['unit'] = Lib::addSelect($this->unit->getUnitList());
        $data['role'] = Lib::addSelect($this->role->getRoleList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return $data;
 	}

    public function getAllUsers($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        if(isset($input['role']) && !empty($input['role'])){
            // get user id of having given role
            $userIds = $this->userRole->getUserIdByRoleId($input['role']);
            if(!empty($userIds)){
                $input['userId'] = $userIds;
            }else{
                $input['userId'] = [-1];
            }
        }
        $users = $this->user->getUsers($input);
        $listArr = [];
        $masterDTO = new MasterDTO();

        if(count($users)){
            foreach ($users as $key => $value) {
                $dto = new UserDTO();
                $dto->setId($value->id);
                $dto->setName($value->first_name." ".$value->last_name);
                $dto->setUsername($value->username);
                $dto->setLastLogin(Lib::convertDateFormat("Y-m-d H:i:s",$value->last_login,"d-m-Y H:i:s"));
                $dto->setRole($value->userRole->role_id);
                $dto->setUnit($value->unit_id);
                $dto->setStatus($value->status);
                $listArr[] = $dto;
            }
        }
        $masterDTO->setListDTO($listArr);
        $masterDTO->setCount($users->currentPage());
        $users->appends(Request::except('page'))->render();
        $masterDTO->setLinks($users->render());
        return $masterDTO;
    }

    public function saveUser($input)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            $input = Lib::trimInput($input);
            DB::beginTransaction();
            $userInsert = [
                'email' => $input['email'],
                'unit_id' => $input['unit'],
                'first_name' => $input['firstname'],
                'last_name' => $input['lastname'],
                'username' => $input['username'],
                'password' => $input['password'],
                'status' => $input['status'],
            ];

            $addedUser = Sentinel::registerAndActivate($userInsert);

            if(count($addedUser)){
                $user = Sentinel::findById($addedUser->id);

                $role = Sentinel::findRoleById($input['role']);
                $role->users()->attach($user);

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

    public function getUserById($id)
    {
        return $this->user->findById($id);
    }

    public function updateUser($input,$id)
    {
        $response = [
            'success' => 0,
            'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
        ];
        try {
            // get users previous data
            $prevUser = $this->getUserById($id);

            $input = Lib::trimInput($input);
            DB::beginTransaction();
            $user = Sentinel::findById($id);
            
            $userUpdate = [
                'email' => $input['email'],
                'unit_id' => $input['unit_id'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'username' => $input['username'],
                'status' => $input['status'],
            ];

            // update user 
            $updateUserSucc = Sentinel::update($user, $userUpdate);

           // $updateUserSucc = $this->user->updateUser($userUpdate,$id);
            
            if(count($updateUserSucc)){
                $prevRole = $prevUser->userRole->role_id;

                if($prevRole != $input['role']){
                     // remove previous role
                    $role = Sentinel::findRoleById($prevRole);
                    $role->users()->detach($user);

                    // add new role
                    $role = Sentinel::findRoleById($input['role']);
                    $role->users()->attach($user);                    
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

    public function resetPassword($input)
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
    }
}