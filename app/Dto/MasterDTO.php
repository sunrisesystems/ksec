<?php
namespace ksec\Dto;

class MasterDTO extends BaseDTO { 
var $listDTO; 
var $count; 
var $links; 

	 public function getListDTO(){
 	 	 return $this->listDTO; 
 	} 
 
 	 public function setListDTO($listDTO){
 	 	 $this->listDTO = $listDTO; 
 	} 

	 public function getCount(){
 	 	 return $this->count; 
 	} 
 
 	 public function setCount($count){
 	 	 $this->count = $count; 
 	} 

	 public function getLinks(){
 	 	 return $this->links; 
 	} 
 
 	 public function setLinks($links){
 	 	 $this->links = $links; 
 	} 


 }
?>