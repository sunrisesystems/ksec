<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvertDetail extends Model
{
	use SoftDeletes;

    protected $guarded = [];
    
    public function saveInvertDetail($data)
    {
    	return $this->insert($data);
    }

    public function getByInvertId($invertId)
    {
    	return $this->where('invert_id',$invertId)->orderBy('product_id','ASC')->get();
    }

    public function getIdsByInvertId($invertId)
    {
    	return $this->where("invert_id",$invertId)->lists('id')->toArray();
    }

    public function saveInvertDetails($data)
    {
    	foreach ($data as $key => $value) {
    		$this->create($value);
    	}
    }

    public function deletedEntriesByIds($ids)
    {
    	return $this->whereIn('id',$ids)->delete();
    }

    public function updateInvertDetail($details)
    {
    	foreach ($details as $key => $value) {
    		$m = $this->find($value['id']);
    		$m->update($value);
    	}
    	return true;
    }

    public function getMachineCountByInvertId($invertId)
    {
    	return $this->where('invert_id',$invertId)->count();
    }
}
