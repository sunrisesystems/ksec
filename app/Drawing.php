<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Drawing extends Model
{
    use SoftDeletes;
	protected $guarded = [];
    
    public function saveDrawing($insert)
    {
    	return $this->create($insert);
    }

    public function getDrawings($input)
    {
    	$query = $this;
        if(isset($input['drawingNo']) && !empty($input['drawingNo'])){
            $query = $query->where('drawing_no','like','%'.$input['drawingNo'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        if(isset($input['shape']) && !empty($input['shape'])){
            $query = $query->where('bottle_shape_id',$input['shape']);
        }
        $drawings = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $drawings;
    }

    public function updateDrawing($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function getDrawingById($id)
    {
        return $this->find($id);
    }

    public function getDrawingList()
    {
        return $this->where('status','A')->lists('drawing_no','id')->toArray();
    }

    public function getMoldTradeNameById($id)
    {
        return $this->where('id',$id)->pluck('mold_trade_name');
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function getByShapeId($shapeId)
    {
        return $this->where('bottle_shape_id',$shapeId)->count();
    }

    public function checkByAccount($manufacturerId)
    {
        return $this->where('manufacturer_id',$manufacturerId)->count();
    }

    public function cheeckByNeckType($typeId)
    {
        return $this->where('neck_type_id',$typeId)->count();
    }

    public function checkByNecksize($necksizeId)
    {
        return $this->where('neck_size_id',$necksizeId)->count();
    }

    public function getAllDrawings()
    {
        return $this->get()->toArray();
    }
}
