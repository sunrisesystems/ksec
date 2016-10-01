<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineModel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function saveMachineModel($insert)
    {
    	return $this->create($insert);
    }

    public function updateMachineModel($update,$id)
    {
    	return $this->find($id)->update($update);
    
    }

    public function getMachineModels($input)
    {
    	$query = $this;
        if(isset($input['machineModel']) && !empty($input['machineModel'])){
            $query = $query->where('machine_model','like','%'.$input['machineModel'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $machineModels = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $machineModels;
    }

    public function getMachineModelById($id)
    {
    	return $this->find($id);
    }

    public function getMachineModelList()
    {
        return $this->where('status','A')->lists('machine_model','id')->toArray();
    }

    public function getByStoreId($storeId)
    {
        return $this->where('store_id',$storeId)->count();
    }

    public function getByManufacturerId($manufacturerId)
    {
        return $this->where('manufacturer_id',$manufacturerId)->count();
    }

    public function getByTypeId($typeId)
    {
        return $this->where('type_id',$typeId)->count();
    }

    public function getAllMachineModels()
    {
        return $this->get()->toArray();
    }
}
