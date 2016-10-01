<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class DowntimeSubreason extends Model
{
    
	use SoftDeletes;
    protected $guarded = [];

    public function saveSubreason($insert)
    {
    	return $this->create($insert);
    }

    public function getSubreasons($input)
    {
    	$query = $this;
        if(isset($input['subreason']) && !empty($input['subreason'])){
            $query = $query->where('subreason','like','%'.$input['subreason'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        if(isset($input['downtimeReason']) && !empty($input['downtimeReason'])){
            $query = $query->where('downtime_reason_id',$input['downtimeReason']);
        }
        $subreasons = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $subreasons;
    }

    public function getSubreasonById($id)
    {
    	return $this->find($id);
    }

    public function updateSubreason($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function deleteSubreason($id)
    {
    	return $this->find($id)->delete();
    }

    public function getSubreasonByReasonId($reasonId)
    {
        return $this->where('downtime_reason_id',$reasonId)->where('status','A')->lists('subreason','id')->toArray();
    }

    public function getSubreasonIdByReasonId($reasonId)
    {
        return $this->whereIn('downtime_reason_id',$reasonId)->where('status','A')->lists('id')->toArray();
    }

    public function getDowntimeSubreasonList()
    {
        return $this->where('status','A')->orderBy('subreason','ASC')->lists('subreason','id')->toArray();
    }

    public function getAllDowntimeSubReasons()
    {
        return $this->get()->toArray();
    }
}
