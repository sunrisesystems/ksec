<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class HourlyEntryDetail extends Model
{
    protected $guarded = [];

    public function getDataByHourlyEntryId($hourlyEntryId)
    {
    	return $this->where('hourly_entry_id',$hourlyEntryId)->get();
    }

    public function saveHourlyEntry($machines)
    {
    	foreach ($machines as $key => $value) {
    		$m = $this->find($value['id']);
    		$m->update($value);
    	}
    	return true;
    }
}
