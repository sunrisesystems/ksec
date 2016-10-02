<?php
namespace ksec\Dto;

class SearchRoleDTO extends BaseDTO { 
var $id; 
var $name; 
var $slug; 
var $permission; 
var $defaultPermission; 

	 public function getDefaultPermission(){
 	 	 return $this->defaultPermission; 
 	} 
 
 	 public function setDefaultPermission($defaultPermission){
 	 	 $this->defaultPermission = $defaultPermission; 
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

	 public function getSlug(){
 	 	 return $this->slug; 
 	} 
 
 	 public function setSlug($slug){
 	 	 $this->slug = $slug; 
 	} 

	 public function getPermission(){
 	 	 return $this->permission; 
 	} 
 
 	 public function setPermission($permission){
 	 	 $this->permission = $permission; 
 	} 


 }

?>