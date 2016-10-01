<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
class Shape extends Model
{
    use SoftDeletes;
    protected $table = 'bottle_shapes';
	protected $guarded = [];
    
    public function getShapeById($id)
    {
    	return $this->find($id);
    }

    public function saveShape($insert)
    {
    	$this->create($insert);
    }

    public function getShapes($input)
    {
        $query = $this;
        if(isset($input['shape']) && !empty($input['shape'])){
            $query = $query->where('shape_name','like','%'.$input['shape'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        $shapes = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $shapes;

    }

    public function updateShape($update,$id)
    {
        return $this->find($id)->update($update);
    }
    
    public function deleteShape($id)
    {
        return $this->find($id)->delete();
    }

    public function getShapeList()
    {
        return $this->where('status','A')->lists('shape_name','id')->toArray();
    }

    public function getShapeCode($shapeId)
    {
        return $this->where('id',$shapeId)->pluck('shape_code');
    }
}
