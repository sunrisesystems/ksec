<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BlowCondition extends Model
{
use SoftDeletes;
    protected $guarded = [];
    
    public function getBlowConditionList()
    {
    	return $this->lists('name','id')->toArray();
    }
}
