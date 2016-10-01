<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class DowntimeReason extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function getDowntimeReasonList()
    {
        return $this->where('status','A')->lists('reason','id')->toArray();
    }
}
