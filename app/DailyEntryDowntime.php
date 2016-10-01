<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class DailyEntryDowntime extends Model
{
    protected $guarded = [];

    public function getDowntimeByDailyEntryMachineId($dailyEntryMachineId)
    {
    	return $this->where('daily_entry_machine_id',$dailyEntryMachineId)->get()->toarray();
    }

    public function deleteByDailyEntryMachineId($dailyEntryMachineId)
    {
    	return $this->where('daily_entry_machine_id',$dailyEntryMachineId)->delete();
    }

     public function saveDowntime($data)
    {
    	return $this->insert($data);
    }

    public function getTotalTimeByDailyEntryMachineId($dailyEntryMachineId)
    {
        return $this->where('daily_entry_machine_id',$dailyEntryMachineId)->sum('total_time');
    }

    public function getDataToCalculateAvailableHrs($dailyEntryMachineId,$subreasonId)
    {
        return $this->whereIn('daily_entry_machine_id',$dailyEntryMachineId)->whereIn('downtime_subreason_id',$subreasonId)->orderBy('start_date_time','asc')->get()->toArray();

    }

    public function getDailyEntryMachinIdList($dailyEntryMachineId,$subreasonId)
    {
        return $this->whereIn('daily_entry_machine_id',$dailyEntryMachineId)->whereIn('downtime_subreason_id',$subreasonId)->orderBy('start_date_time','asc')->lists('daily_entry_machine_id')->toArray();
    }
}
