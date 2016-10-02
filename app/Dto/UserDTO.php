<?php
namespace ksec\Dto;
class UserDTO extends BaseDTO { 
var $id; 
var $firstName; 
var $lastName; 
var $name; 
var $lastLogin; 
var $role; 
var $username; 
var $status;
var $unit; 

	 public function getUnit(){
 	 	 return $this->unit; 
 	} 
 
 	 public function setUnit($unit){
 	 	 $this->unit = $unit; 
 	}  

	 public function getId(){
 	 	 return $this->id; 
 	} 
 
 	 public function setId($id){
 	 	 $this->id = $id; 
 	} 

	 public function getFirstName(){
 	 	 return $this->firstName; 
 	} 
 
 	 public function setFirstName($firstName){
 	 	 $this->firstName = $firstName; 
 	} 

	 public function getLastName(){
 	 	 return $this->lastName; 
 	} 
 
 	 public function setLastName($lastName){
 	 	 $this->lastName = $lastName; 
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

	 public function getRole(){
 	 	 return $this->role; 
 	} 
 
 	 public function setRole($role){
 	 	 $this->role = $role; 
 	} 

	 public function getUsername(){
 	 	 return $this->username; 
 	} 
 
 	 public function setUsername($username){
 	 	 $this->username = $username; 
 	} 

	 public function getStatus(){
 	 	 return $this->status; 
 	} 
 
 	 public function setStatus($status){
 	 	 $this->status = $status; 
 	} 


 }
?>