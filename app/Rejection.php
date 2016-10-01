<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class Rejection extends Model
{
    protected $guarded = [];

    protected $table = 'rejection_inward';

    public function checkRecord($input)
    {
    	return $this->where('date',$input['date'])->where('shift_id',$input['shift'])->where('source',$input['source'])->where('unit_id',$input['unitId'])->first();
    }

    public function saveRejection($insert)
    {
    	return $this->create($insert);
    }

    public function updateRejection($update,$id)
    {
        return $this->find($id)->update($update);
    }

    // relationship with rejection entry details
    public function rejectionInwardDetails()
    {
       return $this->hasMany(RejectionInwardDetail::class,'rejection_inward_id');
    }

    public function saveRejectionDetail($insert,$rejectionId)
    {
        $rejectionEntry = $this->find($rejectionId);
        $result = $rejectionEntry->rejectionInwardDetails()->saveMany($insert);
        return $result; 

    }

    public function getRejectionEntry($input)
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

    public function deleteRejectionEntry($id)
    {
        return $this->find($id)->delete();
    }
}
