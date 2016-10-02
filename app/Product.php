<?php

namespace cvmapp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Lib,DB;
class Product extends Model
{
	use SoftDeletes;
    protected $guarded = [];

     

    public function saveProduct($insert)
    {
    	return $this->create($insert);  
    } 

    // relationship with department
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    // relationship with experts
    public function experts()
    {
        return $this->hasMany(Employee::class);
    }

    public function getProductWithDepartmentById($productId)
    {
        return $this->with("productDepartment")->with('productExpert')->find($productId);
    }

    public function productDepartment()
    {
        return $this->hasMany(ProductDepartment::class);
    }

    public function productExpert()
    {
        return $this->hasMany(ProductExpert::class);
    }

    public function saveDepartment($pd,$id)
    {
        $product = $this->find($id);
        
        return $product->departments()->saveMany($pd);    
    }

    public function saveProductExpert($pe,$id)
    {
        $product = $this->find($id);
        
        return $product->experts()->saveMany($pe);  
    }

    public function getProductsWithAllDetails($input)
     {
        $query = $this;
        if(isset($input['productName']) && !empty($input['productName'])){
            $query = $query->where('name','like','%'.$input['productName'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        
        $products = $query->with('productDepartment.departments')->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $products;
     } 

     public function getProductById($id)
     {
        return $this->find($id);
     }

     public function updateProduct($update,$id)
     {
        return $this->find($id)->update($update);
     }

     

    public function getProductList()
    {
        return $this->lists('name','id')->toArray();   
    }

    public function getActiveProductList()
    {
        return $this->where('status','A')->lists('name','id')->toArray();   
    }


    public function getAllProducts()
    {
        return $this->get()->toArray();
    }

    public function getKeywordSearch($input)
    {
        $productSubcategory = DB::table('product_subcategories')->where('name','like','%'.$input['keyword'].'%')->orWhere('description','like','%'.$input['keyword'].'%')->where('status','A')->select(['name','description',DB::raw('"Product Subcategory" as pageType')]);

        $product = DB::table('products')->where('name','like','%'.$input['keyword'].'%')->orWhere('description','like','%'.$input['keyword'].'%')->where('status','A')->select(['name','description',DB::raw('"Product" as pageType')]);

        $productCategory = DB::table('product_categories')->where('name','like','%'.$input['keyword'].'%')->orWhere('description','like','%'.$input['keyword'].'%')->where('status','A')->select(['name','description',DB::raw('"Prodcut Category" as pageType')]);

        $result = DB::table('products')->where('name','like','%'.$input['keyword'].'%')->orWhere('description','like','%'.$input['keyword'].'%')->where('status','A')->select(['name','description',DB::raw('"Product" as pageType')])
            ->union($productCategory)
            ->union($productSubcategory)
            //->toSql();
            ->paginate($input['paginationLimit']);

        return $result;
    }
}
