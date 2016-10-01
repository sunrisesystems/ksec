<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class Invert extends Model
{
    protected $guarded = [];

    protected $table = 'fg_invert';

    public function checkRecord($input)
    {
    	return $this->where('date',$input['date'])->where('shift_id',$input['shift'])->where('unit_id',$input['unitId'])->first();
    }

    public function saveInvert($insert)
    {
    	return $this->create($insert);
    }

    public function markAsComplete($id)
    {
    	$update['is_completed'] = 'Y';
        return $this->find($id)->update($update);
    }

    public function updateInvert($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function getInvert($input)
    {
        $query = $this;
        if(isset($input['unitId']) && !empty($input['unitId'])){
            $query = $query->where('unit_id',$input['unitId']);
        }
        if(isset($input['date']) && !empty($input['date'])){
            $query = $query->where('date',$input['date']);
        }
         if(isset($input['shift']) && !empty($input['shift'])){
            $query = $query->where('shift_id',$input['shift']);
        }
        $dailyEntry = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $dailyEntry;
    }
 
}
