<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class CallType extends Model
{
    protected $guarded = [];

    public function saveCallType($insert)
    {
    	return $this->create($insert);
    }

    public function getCallTypeById($id)
    {
    	return $this->find($id);
    }

    public function updateCallType($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function getCallTypes($input)
    {
    	return $this->paginate($input['limit']);
    }

    public function getActiveCallTypeList()
    {
        return $this->where('status','A')->lists('call_type','id')->toArray();
    }
}
