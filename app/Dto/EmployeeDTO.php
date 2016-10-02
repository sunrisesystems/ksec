<?php
namespace cvmapp\Dto;
class EmployeeDTO extends BaseDTO { 
var $id; 
var $name; 
var $lastLogin; 
var $profile; 
var $empCode; 
var $status;
var $allowLogin; 
var $empType;
var $department;
var $systemId;

	public function getAllowLogin(){
 	 	return $this->allowLogin; 
 	} 
 
 	public function setAllowLogin($allowLogin){
 	 	$this->allowLogin = $allowLogin; 
 	}

 	public function getSystemId(){
 	 	return $this->systemId; 
 	} 
 
 	public function setSystemId($systemId){
 	 	$this->systemId = $systemId; 
 	}

 	public function getEmpType(){
 	 	return $this->empType; 
 	} 
 
 	public function setEmpType($empType){
 	 	$this->empType = $empType; 
 	}

 	public function getDepartment(){
 	 	return $this->dapertment; 
 	} 
 
 	public function setDepartment($dapertment){
 	 	$this->dapertment = $dapertment; 
 	}


	public function getId(){
 	 	 return $this->id; 
 	} 
 
 	 public function setId($id){
 	 	 $this->id = $id; 
 	} 

	public function getName(){
 	 	return $this->name; 
 	} 
 
 	 public function setName($name){
 	 	 $this->name = $name; 
 	} 

	 public function getLastLogin(){
 	 	 return $this->lastLogin; 
 	} 
 
 	 public function setLastLogin($lastLogin){
 	 	 $this->lastLogin = $lastLogin; 
 	} 

	 public function getProfile(){
 	 	 return $this->profile; 
 	} 
 
 	 public function setProfile($profile){
 	 	 $this->profile = $profile; 
 	} 

	 public function getEmpCode(){
 	 	 return $this->empCode; 
 	} 
 
 	 public function setEmpCode($empCode){
 	 	 $this->empCode = $empCode; 
 	} 

	 public function getStatus(){
 	 	 return $this->status; 
 	} 
 
 	 public function setStatus($status){
 	 	 $this->status = $status; 
 	} 


 }
?>