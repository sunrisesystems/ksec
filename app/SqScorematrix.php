<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class SqScorematrix extends Model
{
    protected $table = 'sq_scorematrix';

    public function getSqParamters($formName,$columnName)
    {
    	return $this->where("formname",$formName)->where('parameter',$columnName)->where('status','A')->orderBy('paraorder','asc')->get();
    }
}
