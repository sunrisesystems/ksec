<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'code';

    public function getCodeList()
    {
    	return $this->lists('code','id')->toArray();
    }
    public function getDataByCodeId($codeId)
    {
    	return $this->where('code_id',$codeId)->where('status','A')->lists('code_value','id')->toArray();
    }
}
