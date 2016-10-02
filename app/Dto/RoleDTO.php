<?php
namespace cvmapp\Dto;

class RoleDTO extends BaseDTO {
    var $SearchRoleDTO;
    var $RoleArr;
    var $Rolelist;
    
    public function getSearchRoleDTO() {
        return $this->SearchRoleDTO;
    }
    
    public function setSearchRoleDTO($SearchRoleDTO) {
        $this->SearchRoleDTO = $SearchRoleDTO;
    }
    
    public function getRoleArr() {
        return $this->RoleArr;
    }
    
    public function setRoleArr($roleArr) {
        $this->RoleArr = $roleArr;
    }
}