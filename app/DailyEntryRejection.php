<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class DailyEntryRejection extends Model
{
    protected $guarded = [];

    public function getRejectionByDailyEntryMachineId($dailyEntryMachineId)
    {
    	return $this->where('daily_entry_machine_id',$dailyEntryMachineId)->get()->toArray();
    }

    public function deleteByDailyEntryMachineId($dailyEntryMachineId)
    {
    	return $this->where('daily_entry_machine_id',$dailyEntryMachineId)->delete();
    }

    public function saveRejection($data)
    {
    	return $this->insert($data);
    }

    public function getTotalRejectionByDailyEntryMachineId($dailyEntryMachineId)
    {
        return $this->where('daily_entry_machine_id',$dailyEntryMachineId)->sum('quantity');
    }

    public function getCountByDailyEntryMachineId($dailyEntryMachineId)
    {
        return $this->where('daily_entry_machine_id',$dailyEntryMachineId)->count();
    }
}
