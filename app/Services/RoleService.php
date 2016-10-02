<?php namespace ksec\Services;

use ksec\Profile as Role;
use Request,Config,Lang,Sentinel;
use ksec\Libraries\Lib;

class RoleService {

    public function __construct(Role $role)
    {
        $this->role = $role;
	}

    public function getRoles()
    {
        return $this->role->getAllRoles();
    }

    public function getRoleById($id)
    {
        return Sentinel::findRoleById($id);
    }

    public function updateRole($update,$id)
    {
        if(!empty($update['permissions'])){
            $requiredFormatArray = [];
            foreach ($update['permissions'] as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $requiredFormatArray[$key.".".$value1] = true;
                }
            }
            if(!empty($requiredFormatArray)){
                $role = Sentinel::findRoleById($id);

                $role->permissions = $requiredFormatArray;

                $role->save();
            }
            return true;
        }else{
            return true;
        }
    }
}