<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefectReason extends Model
{
    use SoftDeletes;
	protected $guarded = [];

	public function getDefectReasonList()
	{
        return $this->lists('reason','id')->toArray();
	}

}
