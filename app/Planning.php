<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class Planning extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function getPlanningByMachineId($machineId)
    {
    	return $this->whereIn('status',['P','R'])->where('machine_id',$machineId)->orderBy('status','desc')->orderBy('start_date_time','asc')->get();
    }

    public function checkDateTime($data)
    {
        if(isset($data['planId']) && !empty($data['planId'])){
            $count = $this->where('status','A')->where('machine_id',$data['machineId'])->where('start_date_time','<=',$data['date'])->where('end_date_time','>=',$data['date'])->where('id','!=',$data['planId'])->count();
            
        }else{
            $count = $this->where('status','A')->where('machine_id',$data['machineId'])->where('start_date_time','<=',$data['date'])->where('end_date_time','>=',$data['date'])->count();
        }
        return $count; 
    }

    public function savePlanning($insert)
    {
        return $this->create($insert);
    }

    public function updatePlanning($update,$id)
    {
        return $this->find($id)->update($update);
    }
    
    public function getPlannings($input)
    {
        $query = $this->join('machines','plannings.machine_id','=','machines.id');
        if(isset($input['machine']) && !empty($input['machine'])){
            $query = $query->where('plannings.machine_id',$input['machine']);
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('plannings.status',$input['status']);
        }
        if(isset($input['product']) && !empty($input['product'])){
            $query = $query->where('plannings.product_id',$input['product']);
        }
        if(isset($input['startDate']) && !empty($input['startDate'])){
            $query = $query->where('plannings.start_date_time','>=',$input['startDate']."00:00:00");
        }
        if(isset($input['endDate']) && !empty($input['endDate'])){
            $query = $query->where('plannings.end_date_time','<=',$input['endDate']."23:59:59");
        }
        if(isset($input['unitId']) && !empty($input['unitId'])){
            $query = $query->where('plannings.unit_id',$input['unitId']);
        }
        $plannings = $query->orderBy('machines.inhouse_serial_no','asc')->orderByRaw(DB::raw("FIELD(plannings.status,'R','P','SC','C','CN')"))->select('plannings.*','machines.inhouse_serial_no')->paginate($input['paginationLimit']);
       // echo $plannings; exit;
        //orderBy('plannings.status','R','SC','C','CN')->
        return $plannings;
    }

    public function getPlanningById($id)
    {
        return $this->find($id);
    }

    public function getPlansForDailyEntry($data,$dates)
    {
        return $this->join('machines','plannings.machine_id','=','machines.id')
                    ->where('plannings.status','R')
                    ->orWhere(function ($query) use($dates) {
                        $query->whereIn('plannings.status',['C','SC'])
                              ->whereBetween('plannings.close_date_time',$dates);
                    })
                    ->whereIn('plannings.machine_id',$data['machineIds'])->orderBy('machines.inhouse_serial_no','asc')->select(['plannings.id','plannings.machine_id','plannings.product_id','machines.inhouse_serial_no'])->get();
    }

    public function getRunningPlanCountByMachineId($machineId)
    {
        return $this->where('machine_id',$machineId)->where('status','R')->count();
    }

    public function getShortClosePlanWithinShift($dates,$data)
    {
        return $this->where('status','SC')->whereBetween('close_date_time',$dates)->select(['id','machine_id','product_id'])->get();
    }

    public function getStatusById($id)
    {
        return $this->where('id',$id)->pluck('status');
    }
}
