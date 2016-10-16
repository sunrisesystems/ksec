<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class CallTypeSub extends Model
{
    protected $guarded = [];
    
    protected $table = 'call_types_sub';

    public function getSubCallTypeByCallId($callTypeId)
    {
    	return $this->where('status','A')->where('call_type_id',$callTypeId)->lists('subcall_type','id')->toArray();
    }
}
