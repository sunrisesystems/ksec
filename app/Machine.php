<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
 	use SoftDeletes;
	protected $guarded = [];
    
    public function saveMachine($insert)
    {
    	return $this->create($insert);
    } 

    public function getMachines($input)
    {
      	$query = $this;
        if(isset($input['moldingMachineName']) && !empty($input['moldingMachineName'])){
            $query = $query->where('molding_machine_name','like','%'.$input['moldingMachineName'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        if(isset($input['unitId']) && !empty($input['unitId'])){
            $query = $query->where('manufacturing_unit',$input['unitId']);
        }
        $machines = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $machines;
    }  

    public function getMachineById($id)
    {
    	return $this->find($id);
    }

    public function updateMachine($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function deleteMachine($id)
    {
        return $this->find($id)->delete();
    }

    public function getMachineByUnitId($unitId)
    {
        return $this->where('manufacturing_unit',$unitId)->where('status','A')->orderBy('inhouse_serial_no','asc')->lists('molding_machine_inhouse_name','id')->toArray();
    }

    public function getAllMachines()
    {
        return $this->get()->toArray();
    }
}
