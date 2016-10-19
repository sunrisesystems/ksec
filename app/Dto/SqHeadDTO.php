<?php

namespace ksec\Dto; 
class SqHeadDTO extends BaseDTO { 
var $id; 
var $date; 
var $process; 
var $agent; 
var $manager; 
var $tl; 
var $agentCategory; 
var $fatal; 
var $adherence; 
var $qualityPer; 
var $appreciation; 

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

	 public function getProcess(){
 	 	 return $this->process; 
 	} 
 
 	 public function setProcess($process){
 	 	 $this->process = $process; 
 	} 

	 public function getAgent(){
 	 	 return $this->agent; 
 	} 
 
 	 public function setAgent($agent){
 	 	 $this->agent = $agent; 
 	} 

	 public function getManager(){
 	 	 return $this->manager; 
 	} 
 
 	 public function setManager($manager){
 	 	 $this->manager = $manager; 
 	} 

	 public function getTl(){
 	 	 return $this->tl; 
 	} 
 
 	 public function setTl($tl){
 	 	 $this->tl = $tl; 
 	} 

	 public function getAgentCategory(){
 	 	 return $this->agentCategory; 
 	} 
 
 	 public function setAgentCategory($agentCategory){
 	 	 $this->agentCategory = $agentCategory; 
 	} 

	 public function getFatal(){
 	 	 return $this->fatal; 
 	} 
 
 	 public function setFatal($fatal){
 	 	 $this->fatal = $fatal; 
 	} 

	 public function getAdherence(){
 	 	 return $this->adherence; 
 	} 
 
 	 public function setAdherence($adherence){
 	 	 $this->adherence = $adherence; 
 	} 

	 public function getQualityPer(){
 	 	 return $this->qualityPer; 
 	} 
 
 	 public function setQualityPer($qualityPer){
 	 	 $this->qualityPer = $qualityPer; 
 	} 

	 public function getAppreciation(){
 	 	 return $this->appreciation; 
 	} 
 
 	 public function setAppreciation($appreciation){
 	 	 $this->appreciation = $appreciation; 
 	} 


 }
?>