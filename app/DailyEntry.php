<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use ksec\Libraries\Lib;

class DailyEntry extends Model
{
    protected $guarded = [];
    
    public function checkRecord($input)
    {
    	return $this->where('date',$input['date'])->where('shift_id',$input['shift'])->where('unit_id',$input['unitId'])->first();
    }

    public function saveDailyEntry($insert)
    {
    	return $this->create($insert);
    }

    // relationship with daily entriy machines
    public function dailyEntryMachine()
    {
       return $this->hasMany(DailyEntryMachine::class,'daily_entry_id');
    }

    public function saveDailyEntryMachine($insert,$dailyEntryId)
    {
        $dailyEntry = $this->find($dailyEntryId);
        $result = $dailyEntry->dailyEntryMachine()->saveMany($insert);
        return $result; 

    }

    public function updateDailyEntry($update,$id)
    {
        $dailyEntry = $this->find($id);

        $result = $dailyEntry->update($update);
        
        return $result;
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function getDailyEntry($input)
    {
        $query = $this;
        if(isset($input['unitId']) && !empty($input['unitId'])){
            $query = $query->where('unit_id',$input['unitId']);
        }
        if(isset($input['date']) && !empty($input['date'])){
            $query = $query->where('date',$input['date']);
        }
         if(isset($input['shift']) && !empty($input['shift'])){
            $query = $query->where('shift_id',$input['shift']);
        }
        $dailyEntry = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $dailyEntry;
    }

    public function markAsComplete($id)
    {
        $update['is_completed'] = 'Y';
        return $this->find($id)->update($update);
    }

    public function deleteDailyEntry($id)
    {
        return $this->find($id)->delete();
    }

    public function getDateById($id)
    {
        return $this->where('id',$id)->pluck('date');
    }
}
