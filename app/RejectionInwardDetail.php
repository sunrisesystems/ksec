<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class RejectionInwardDetail extends Model
{
    protected $guarded = [];
    
    public function deleteByInwardId($inwardId)
    {
    	return $this->where('rejection_inward_id',$inwardId)->delete();
    }

    public function saveRejectionInward($insert)
    {
    	return $this->insert($insert);
    }

    public function getByInwardId($inwardId)
    {
    	return $this->where('rejection_inward_id',$inwardId)->get();
    }

    public function updateRejectionDetail($update,$id)
    {
        return $this->find($id)->update($update);
    }

    public function checkInCompleteRecord($rejectionId)
    {
        return $this->where('is_completed','N')->where('rejection_inward_id',$rejectionId)->count();
    }

}
