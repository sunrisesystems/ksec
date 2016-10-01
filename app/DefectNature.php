<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefectNature extends Model
{
    use SoftDeletes;
	protected $guarded = [];
	protected $table = "defect_nature";

	public function getDefectNatureList()
	{
        return $this->lists('nature','id')->toArray();
	}
}
