<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $guarded = [];

    public function getShiftListByUnit($unitId)
    {
    	return $this->where('unit_id',$unitId)->lists('shift_name','id')->toArray();
    }

    public function getShiftById($shiftId)
    {
    	return $this->find($shiftId);
    }
    
    public function getShifts($unitId)
    {
    	return $this->where('unit_id',$unitId)->select(['id','shift_name','start_time','end_time'])->get()->toArray();
    }

    public function getShiftName($shiftId)
    {
        return $this->whereIn('id',$shiftId)->lists('shift_name','id')->toArray();
    }
}
