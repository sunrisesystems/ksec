<?php
namespace ksec\Dto;

class RejectionEntryDTO extends BaseDTO { 
var $id; 
var $date;  
var $updatedTime; 
var $shift; 
var $source;
var $isCompleted; 
var $allowDelete; 

	 public function getAllowDelete(){
 	 	 return $this->allowDelete; 
 	} 
 
 	 public function setAllowDelete($allowDelete){
 	 	 $this->allowDelete = $allowDelete; 
 	} 

	 public function getIsCompleted(){
 	 	 return $this->isCompleted; 
 	} 
 
 	 public function setIsCompleted($isCompleted){
 	 	 $this->isCompleted = $isCompleted; 
 	} 

	public function getShift(){
 	 	return $this->shift; 
 	} 
 
 	public function setShift($shift){
 	 	$this->shift = $shift; 
 	} 

	 public function getId(){
 	 	 return $this->id; 
 	} 
 
 	 public function setId($id){
 	 	 $this->id = $id; 
 	} 

	 public function getDate(){
 	 	 return $this->date; 
 	} 
 
 	 public function setDate($date){
 	 	 $this->date = $date; 
 	} 

	public function getSource(){
 	 	 return $this->source; 
 	} 
 
 	 public function setSource($source){
 	 	 $this->source = $source; 
 	} 


 }
?>