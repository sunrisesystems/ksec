<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Lib;

class SqHead extends Model
{
    protected $table = 'sq_head';

    protected $guarded = [];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function saveSqHead($insert)
    {
    	return $this->create($insert);
    }

    public function getSqHeadByFormId($input)
    {
    	$query = $this;
    	$result = $query->where('form_id',$input['form_id'])->paginate($input['paginationLimit']);
    	return $result;
    }

    // relationship with fatal
    public function sqFatal()
    {
        return $this->hasOne(SqFatal::class,'sq_head_id');
    }

    // relationship with adherence
    public function sqAdherence()
    {
        return $this->hasOne(SqAdherence::class,'sq_head_id');
    }

    // relationship with quality voice
    public function sqQualityVoice()
    {
        return $this->hasOne(SqQualityVoice::class,'sq_head_id');
    }

    public function getSqHeadById($id)
    {
        return $this->with('sqFatal')->with('sqAdherence')->with('sqQualityVoice')->find($id);
    }

    public function updateSqHead($update,$id)
    {
        return $this->find($id)->update($update);
    }

    // relationship with agent
    public function agent()
    {
        return $this->belongsTo(Employee::class,'agent_id','id');
    }

    // relationship with teamLead
    public function teamLead()
    {
        return $this->belongsTo(Employee::class,'tl_id','id');
    }

    // relationship with teamLead
    public function manager()
    {
        return $this->belongsTo(Employee::class,'manager_id','id');
    }

    // relationship with process
    public function process()
    {
        return $this->belongsTo(Process::class,'process_id','id');
    }

    // relationship with sqform
    public function sqForm()
    {
        return $this->belongsTo(SqForm::class,'form_id','id');
    }

    // relationship with cateogry (code value)
    public function category()
    {
        return $this->belongsTo(CodeValue::class,'cat_id','id');
    }

    public function getAuditData($input)
    {
        $query = $this;

        $query = $query->with(["agent"=>function($agentQuery){
            $agentQuery = $agentQuery->select('emp_name','id');
        }]);

        $query = $query->with(["teamLead"=>function($tlQuery){
            $tlQuery = $tlQuery->select('emp_name','id');
        }]);

        $query = $query->with(["manager"=>function($mQuery){
            $mQuery = $mQuery->select('emp_name','id');
        }]);

        $query = $query->with(["process"=>function($processQuery){
            $processQuery = $processQuery->select('process','id');
        }]);

        $query = $query->with(["sqForm"=>function($formQuery){
            $formQuery = $formQuery->select('formname','id');
        }]);

        $query = $query->with(["category"=>function($categoryQuery){
            $categoryQuery = $categoryQuery->select('code_value','id');
        }]);

        if(!empty($input['startDate'])){
            $query = $query->where('trdate','>=',Lib::convertDateFormat("d-M-Y",$input['startDate'],"Y-m-d"));
        }

        if(!empty($input['endDate'])){
            $query = $query->where('trdate',"<=",Lib::convertDateFormat("d-M-Y",$input['endDate'],"Y-m-d"));
        }

        if(isset($input['agent']) && !empty($input['agent'])){
            $query = $query->whereIn('agent_id',$input['agent']);
        }

        if(isset($input['teamLead']) && !empty($input['teamLead'])){
            $query = $query->whereIn('tl_id',$input['teamLead']);
        }

        if(isset($input['manager']) && !empty($input['manager'])){
            $query = $query->whereIn('manager_id',$input['manager']);
        }

        if(isset($input['clientCode']) && !empty($input['clientCode'])){
            $query = $query->where('client_id',$input['clientCode']);
        }

        if(isset($input['process']) && !empty($input['process'])){
            $query = $query->whereIn('process_id',$input['process']);
        }

        if(isset($input['formName']) && !empty($input['formName'])){
            $query = $query->whereIn('form_id',$input['formName']);
        }

        return $query->paginate($input['paginationLimit']);
    }
}
