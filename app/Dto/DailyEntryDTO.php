<?php
namespace ksec\Dto;

class DailyEntryDTO extends BaseDTO { 
var $id; 
var $date; 
var $totalMachine; 
var $totalDowntime; 
var $updatedTime; 
var $shift; 
var $totalRejection; 
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

	 public function getTotalRejection(){
 	 	 return $this->totalRejection; 
 	} 
 
 	 public function setTotalRejection($totalRejection){
 	 	 $this->totalRejection = $totalRejection; 
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

	 public function getTotalMachine(){
 	 	 return $this->totalMachine; 
 	} 
 
 	 public function setTotalMachine($totalMachine){
 	 	 $this->totalMachine = $totalMachine; 
 	} 

	 public function getTotalDowntime(){
 	 	 return $this->totalDowntime; 
 	} 
 
 	 public function setTotalDowntime($totalDowntime){
 	 	 $this->totalDowntime = $totalDowntime; 
 	} 

	 public function getUpdatedTime(){
 	 	 return $this->updatedTime; 
 	} 
 
 	 public function setUpdatedTime($updatedTime){
 	 	 $this->updatedTime = $updatedTime; 
 	} 


 }
?>