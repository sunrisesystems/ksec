<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CodeValue extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getDataByCodeId($codeId)
    {
    	return $this->where('code_id',$codeId)->where('status','A')->orderBy('code_value','asc')->lists('code_value','id')->toArray();
    }

    public function saveCodeValue($insert)
    {
    	return $this->create($insert);
    }

    public function getCodeValues($input)
    {
         $query = $this;
        if(isset($input['codeId']) && !empty($input['codeId'])){
            $query = $query->where('code_id',$input['codeId']);
        }
        if(isset($input['codeValue']) && !empty($input['codeValue'])){
            $query = $query->where('code_value','like','%'.$input['codeValue'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $codeValues = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $codeValues;
    }

    public function getById($id)
    {
        $d = $this->find($id);
        return $d;
    }

    public function updateCodeValue($update, $id)
    {
        return $this->find($id)->update($update);
    }
    
}
