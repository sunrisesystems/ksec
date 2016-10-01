<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Lib,DB;

class DailyEntryMachine extends Model
{
    protected $guarded = [];

    public function getDataByDailyEntryId($dailyEntryId)
    {
    	return $this->where('daily_entry_id',$dailyEntryId)->get();
    }

    public function updateDailyEntryMachine($machines)
    {
    	foreach ($machines as $key => $value) {
    		$m = $this->find($value['id']);
    		$m->update($value);
    	}
    	return true;
    }

    public function updateData($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function getMachineCountByDailyEntryId($dailyEntryId)
    {
        return $this->where('daily_entry_id',$dailyEntryId)->count();
    }

    public function updateForTotalDowntime($dailyEntryMachineId)
    {
        $result = \DB::select(\DB::raw("update daily_entry_machines set total_downtime = (select sum(total_time) from daily_entry_downtimes where daily_entry_machine_id = ".$dailyEntryMachineId.") where id = ".$dailyEntryMachineId));
        return $result;
    }

    public function getTotalDowntimeByDailyEntryId($dailyEntryId)
    {
        //return $this->where('daily_entry_id',$dailyEntryId)->sum('total_downtime');
        return \DB::select(\DB::raw("SELECT  SEC_TO_TIME( SUM( TIME_TO_SEC( `total_downtime` ) ) ) AS totalDowntime  FROM daily_entry_machines where daily_entry_id = ".$dailyEntryId));
    }

    public function getTotalRejectionByDailyEntryId($dailyEntryId)
    {
        return $this->where('daily_entry_id',$dailyEntryId)->sum('total_rejection');
    }

    public function getIncompleteCount($dailyEntryId)
    {
        return $this->where('daily_entry_id',$dailyEntryId)->where('is_completed','N')->count();
    }

    public function getMachineListByDailyEntry($dailyEntryId)
    {
        return $this->where("daily_entry_id",$dailyEntryId)->lists('machine_id','id')->toArray();
    }

    public function getIdByMachineIdAndDailyEntryId($dailyEntryId,$machineId)
    {
        return $this->where('daily_entry_id',$dailyEntryId)->where('machine_id',$machineId)->lists('id')->toArray();
    }

    public function updateAvailableHrsByMachineIdAndDailyEntryId($dailyEntryId,$machineId,$update)
    {
        return $this->where('daily_entry_id',$dailyEntryId)->where('machine_id',$machineId)->update($update);
    }

    public function getDailyProductionReport($input)
    {
        return \DB::select(\DB::raw("SELECT machine_id,product_id,sum(production_quantity) Net_Prod,sec_to_time(sum(time_to_sec(total_downtime))) DT,sec_to_time(sum(time_to_sec(available_hrs))) AH, sec_to_time(sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime))) as Act_AH,draw.std_cavities,draw.std_wt_c,draw.sct_c,(sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime)))*draw.std_cavities/draw.sct_c as std_prod, sum(production_quantity)*(draw.std_wt_c/1000) as Net_Prod_KGS, sum(total_rejection) Rej,sum(total_rejection)*(draw.std_wt_c/1000) as Rej_KGS,sum(Purging) as Purging_KGS,((sum(production_quantity)*(draw.std_wt_c/1000))*100)/((sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime)))*draw.std_cavities/draw.sct_c) as CU FROM daily_entry_machines dem left join daily_entries de on de.id=daily_entry_id left join products p on p.id=dem.product_id left join drawings draw on draw.id=p.drawing_id where de.shift_id in (".implode(",",$input['shift']).") and (date>= '".$input["fromDate"]."' and de.date<='".$input["toDate"]."') group by machine_id,product_id order by dem.machine_id, dem.product_id"));   
    }

    public function getManagementReport($input)
    {
        return \DB::select(\DB::raw("SELECT sum(production_quantity) Net_Prod,sec_to_time(sum(time_to_sec(total_downtime))) DT,sec_to_time(sum(time_to_sec(available_hrs))) AH, sec_to_time(sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime))) as Act_AH,draw.std_cavities,draw.std_wt_c,draw.sct_c,(sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime)))*draw.std_cavities/draw.sct_c as std_prod, sum(production_quantity)*(draw.std_wt_c/1000) as Net_Prod_KGS, sum(total_rejection) Rej,sum(total_rejection)*(draw.std_wt_c/1000) as Rej_KGS,sum(Purging) as Purging_KGS, 
            (sum(production_quantity)*100)/((sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime)))*draw.std_cavities/draw.sct_c)  as CU FROM daily_entry_machines dem left join daily_entries de on de.id=daily_entry_id left join products p on p.id=dem.product_id left join drawings draw on draw.id=p.drawing_id where de.shift_id in (".implode(",",$input['shift']).") and (date= '".$input["date"]."')"));
    }

    public function getDailyProductionMtd($input)
    {
        return \DB::select(\DB::raw("SELECT sum(production_quantity) Net_Prod,sec_to_time(sum(time_to_sec(total_downtime))) DT,sec_to_time(sum(time_to_sec(available_hrs))) AH, sec_to_time(sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime))) as Act_AH,draw.std_cavities,draw.std_wt_c,draw.sct_c,(sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime)))*draw.std_cavities/draw.sct_c as std_prod, sum(production_quantity)*(draw.std_wt_c/1000) as Net_Prod_KGS, sum(total_rejection) Rej,sum(total_rejection)*(draw.std_wt_c/1000) as Rej_KGS,sum(Purging) as Purging_KGS, 
            (sum(production_quantity)*100)/((sum(time_to_sec(available_hrs))- sum(time_to_sec(total_downtime)))*draw.std_cavities/draw.sct_c)  as CU FROM daily_entry_machines dem left join daily_entries de on de.id=daily_entry_id left join products p on p.id=dem.product_id left join drawings draw on draw.id=p.drawing_id where de.shift_id in (".implode(",",$input['shift']).") and date <='".$input["date"]."' and date >= '".$input["fromDate"]."'"));
    }

    public function getTotalDowntime($input)
    {
        return DB::select("SELECT sec_to_time(sum(time_to_sec(ded.total_time))) DT FROM daily_entry_machines dem left join daily_entries de on de.id=daily_entry_id left join products p on p.id=dem.product_id left join daily_entry_downtimes ded on dem.id=ded.daily_entry_machine_id left join downtime_subreasons ds on ds.id=ded.downtime_subreason_id where de.shift_id in (".implode(",",$input['shift']).") and (date>= '".$input["fromDate"]."' and de.date<='".$input["toDate"]."') ");
    }


    public function getProductionDowntime($input)
    {
        return DB::select("SELECT sec_to_time(sum(time_to_sec(ded.total_time))) DT FROM daily_entry_machines dem left join daily_entries de on de.id=daily_entry_id left join products p on p.id=dem.product_id left join daily_entry_downtimes ded on dem.id=ded.daily_entry_machine_id left join downtime_subreasons ds on ds.id=ded.downtime_subreason_id where de.shift_id in (".implode(",",$input['shift']).") and (date= '".$input["date"]."') and ds.downtime_reason_id=1");
    }

    public function getMoldChangeOverDowntime($input)
    {
        return DB::select("SELECT sec_to_time(sum(time_to_sec(ded.total_time))) DT FROM daily_entry_machines dem left join daily_entries de on de.id=daily_entry_id left join products p on p.id=dem.product_id left join daily_entry_downtimes ded on dem.id=ded.daily_entry_machine_id left join downtime_subreasons ds on ds.id=ded.downtime_subreason_id where de.shift_id in (".implode(",",$input['shift']).") and (date= '".$input["date"]."') and ds.downtime_reason_id=4");
    }

    public function getPowerBreakDownDowntime($input)
    {
        return DB::select("SELECT sec_to_time(sum(time_to_sec(ded.total_time))) DT FROM daily_entry_machines dem left join daily_entries de on de.id=daily_entry_id left join products p on p.id=dem.product_id left join daily_entry_downtimes ded on dem.id=ded.daily_entry_machine_id left join downtime_subreasons ds on ds.id=ded.downtime_subreason_id where de.shift_id in (".implode(",",$input['shift']).") and (date= '".$input["date"]."') and ds.downtime_reason_id=8");
    }

    public function getOtherDowntime($input)
    {
        return DB::select("SELECT sec_to_time(sum(time_to_sec(ded.total_time))) DT FROM daily_entry_machines dem left join daily_entries de on de.id=daily_entry_id left join products p on p.id=dem.product_id left join daily_entry_downtimes ded on dem.id=ded.daily_entry_machine_id left join downtime_subreasons ds on ds.id=ded.downtime_subreason_id where de.shift_id in (".implode(",",$input['shift']).") and (date= '".$input["date"]."') and ds.downtime_reason_id not in (1,4,8)");
    }

}
