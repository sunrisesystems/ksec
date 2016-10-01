<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DrawingAttachment extends Model
{
    use SoftDeletes;
	protected $guarded = [];
    
    public function saveAttachment($insert)
    {
    	return $this->create($insert);
    }

    public function updateAttachment($update,$id)
    {
    	return $this->find($id)->update($update);
    }

    public function deleteByDrawingId($drawingId)
    {
    	return $this->where('drawing_id',$drawingId)->delete();
    }

    public function getByDrawingId($drawingId)
    {
        return $this->where('drawing_id',$drawingId)->get();
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }
}
