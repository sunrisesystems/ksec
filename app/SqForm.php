<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class SqForm extends Model
{
    protected $guarded = [];

    public function getFormList()
    {
    	return $this->lists('formname','id')->toArray();
    }
}
