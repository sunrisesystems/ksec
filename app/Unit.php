<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getUnitList()
    {
    	return $this->where('status','A')->lists('unit_name','id')->toArray();
    }

    public function getUnitById($id)
    {
    	return $this->find($id);
    }

    public function getTimeZoneByUnitId($unitId)
    {
        return $this->where('id',$unitId)->pluck('time_zone');
    }

    public function getUnitName($unitId)
    {
        return $this->where('id',$unitId)->pluck('unit_name');
    }
}
