<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use DB;
class HourlyEntry extends Model
{
    protected $guarded = [];
    
    public function checkRecord($input)
    {
    	return $this->where('date',$input['date'])->where('shift_id',$input['shift'])->where('time','like',"%".$input['time']."%")->where('unit_id',$input['unitId'])->first();
    }

    public function saveHourlyEntry($insert)
    {
    	return $this->create($insert);
    }

    // relationship with daily entriy machines
    public function hourlyEntryDetails()
    {
       return $this->hasMany(HourlyEntryDetail::class,'hourly_entry_id');
    }

    public function saveHourlyEntryDetail($insert,$hourlyEntryId)
    {
        $hourlyEntry = $this->find($hourlyEntryId);
        $result = $hourlyEntry->hourlyEntryDetails()->saveMany($insert);
        return $result; 

    }

    public function updateHourlyEntry($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function getHoulyEntry($input)
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
        $dailyEntry = $query->orderBy('time','asc')->paginate($input['paginationLimit']);
        return $dailyEntry;
    }

    public function getById($id)
    {
    	return $this->find($id);
    }

    public function deleteHourlyEntry($id)
    {
        return $this->find($id)->delete();
    }

    public function getProductionRejection($input)
    {
        $unit = $input['unitId'];
        $date = $input['date'];
        $shift = $input['shift'];
        return DB::select(DB::raw("select id as colorId,color,sum(rej_kgs) rejectionKgs from (select cl.id,cl.color,machine_id,product_id,sum(total_rejection) sum_rej,((select avg(average_wt) avg_wt  from hourly_entry_details hed left join hourly_entries he on he.id=hed.hourly_entry_id where hed.machine_id=dem.machine_id and hed.product_id=dem.product_id and he.date='".$date."' and he.shift_id=".$shift." and he.unit_id=".$unit.")/1000)*sum(total_rejection) as Rej_kgs from daily_entry_machines dem left join daily_entries de on de.id=dem.daily_entry_id left join products pr on pr.id=dem.product_id left join colors cl on cl.id=pr.color_id where de.date='".$date."' and de.shift_id=".$shift." and de.unit_id=".$unit." group by machine_id,product_id) tv group by color,id having sum(rej_kgs)>0"));
    }
}
