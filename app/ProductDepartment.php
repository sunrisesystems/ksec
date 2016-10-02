<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;


class ProductDepartment extends Model
{
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

    public function deleteProductDepartment($productId)
    {
    	return $this->where('product_id',$productId)->delete();
    }
}
