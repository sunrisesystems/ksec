<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class ProductExpert extends Model
{
    protected $guarded = [];

    public function deleteProductExpert($productId)
    {
    	return $this->where('product_id',$productId)->delete();
    }
}
