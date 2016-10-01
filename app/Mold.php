<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mold extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    
    public function getMoldById($id)
    {
    	return $this->find($id);
    }

    public function saveMold($insert)
    {
    	return $this->create($insert);
    }

    public function getMolds($input)
    {
    	$query = $this;
        if(isset($input['moldName']) && !empty($input['moldName'])){
            $query = $query->where('mold_name','like','%'.$input['moldName'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        if(isset($input['unitId']) && !empty($input['unitId'])){
            $query = $query->where('unit_id',$input['unitId']);
        }
        $drawings = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $drawings;
    }

    public function updateMold($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function deleteMold($id)
    {
    	return $this->find($id)->delete();
    }

    public function getMoldCountByDrawingId($drawingId)
    {
        return $this->where('drawing_id',$drawingId)->count();
    }

    public function getByStoreId($storeId)
    {
        return $this->where('store_id',$storeId)->count();
    }

    public function checkForAccount($manufacturerId)
    {
        return $this->where('manufacturer_id',$manufacturerId)->count();
    }

    public function checkByTypeId($typeId)
    {
        return $this->where('type_id',$typeId)->count();
    }

    public function checkMolds($data,$id = null)
    {
        if(!empty($id)){
            return $this->where('mother_mold',$data['mother_mold'])->where('blow_mold',$data['blow_mold'])->where('injection_mold',$data['injection_mold'])->where('id','!=',$id)->count();
        }else{
            return $this->where('mother_mold',$data['mother_mold'])->where('blow_mold',$data['blow_mold'])->where('injection_mold',$data['injection_mold'])->count();

        }
    }

    public function getMoldByDrawingId($drawingId)
    {
        return $this->where('status','A')->where('drawing_id',$drawingId)->lists('mold_name','id')->toArray();
    }

    public function getMoldByUnitId($unitId)
    {
        return $this->where('status','A')->where('unit_id',$unitId)->where('priority','P')->lists('mold_name','id')->toArray();
    }

    public function getMoldByPriorityUnitId($unitId)
    {
        return $this->where('status','A')->where('unit_id',$unitId)->whereIn('priority',['P','S'])->orderBy('priority','asc')->select(['mold_name','id','priority'])->get()->toArray();
    }    

    public function getAllMolds()
    {
        return $this->orderBy('mold_name','ASC')->get()->toArray();
    }
}
