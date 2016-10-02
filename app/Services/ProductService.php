<?php namespace ksec\Services;

use ksec\Department;
use ksec\ProductDepartment;
use ksec\ProductExpert;
use ksec\ProductCategory;
use ksec\ProductSubcategory;
use ksec\Product;
use ksec\Employee;

use Request,Config,DB,Validator,Lang,Lib,Sentinel;

class ProductService {

    public function __construct(Department $department,
                                Product $product,
                                ProductDepartment $productDepartment,
                                ProductCategory $productCategory,
                                ProductSubcategory $productSubcategory,
                                Employee $employee,
                                ProductExpert $productExpert)
    {
       $this->department = $department;
       $this->product = $product;
       $this->productDepartment = $productDepartment;
       $this->productCategory = $productCategory;
       $this->productSubcategory = $productSubcategory;
       $this->employee = $employee;
       $this->productExpert = $productExpert;
	}

       
    public function getAllData()
    {
        $data = [];
        $data['department'] = $this->department->getActiveDepartmentList();
        $data['employee'] = $this->employee->getActiveEmployeeEmailList();
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return $data;
    } 

    public function getAllDataForIndex()
    {
        $data = [];
        $data['department'] = $this->department->getAllDepartmentList();
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return $data;
    } 

    public function getAllProdcutCategoryData()
    {
        $data = [];
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['products'] = Lib::addSelect($this->product->getActiveProductList());
        return $data;
    }

    public function getAllProdcutCategoryDataForIndex()
    {
        $data = [];
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['products'] = Lib::addSelect($this->product->getProductList());
        return $data;
    }

    public function getAllProductSubcategoryData()
    {
        $data = [];
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['productCategory'] = Lib::addSelect($this->productCategory->getActiveProductCategoryList());
        return $data;
    }

    public function getAllProductSubcategoryDataForIndex()
    {
        $data = [];
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        $data['productCategory'] = Lib::addSelect($this->productCategory->getProductCategoryList());
        return $data;
    }

    public function saveProduct($input)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
            ];
            DB::beginTransaction();

            // insert product first
            $productInsert = [
                'name' => $input['productName'],
                'description' => $input['description'],
                'status' => $input['status'],
            ];

            $product = $this->product->saveProduct($productInsert);

            if(count($product)){
                $pd = [];
                foreach ($input['department'] as $key => $value) {
                    $pd[$key] = new ProductDepartment();
                    $pd[$key]['department_id'] = $value;
                }
                if(!empty($pd)){
                    $pdSucc = $this->product->saveDepartment($pd,$product->id);
                    if($pdSucc){
                        $pe = [];
                        foreach ($input['employee'] as $key => $value) {
                            $pe[$key] = new ProductExpert();
                            $pe[$key]['employee_id'] = $value;
                        }
                        if(!empty($pe)){
                            $peSucc = $this->product->saveProductExpert($pe,$product->id);
                            if($peSucc){
                                $response['success'] = 1;
                                DB::commit();
                            }
                        }else{
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }else{
                    DB::rollback();
                }
            }else{
                DB::rollback();
            }

        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = $e->getMessage();
        }finally{
            return $response;
        }
    } 

    public function getProducts($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $data = $this->product->getProductsWithAllDetails($input);
        return $data;
    }  

    public function getProductWithDepartmentById($productId)
    {
      return $this->product->getProductWithDepartmentById($productId);
    }

    public function updateProduct($update,$id)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get ( 'messages.PROCESS_FAIL' ) 
            ];
            DB::beginTransaction();

            // insert product first
            $productUpdate = [
                'name' => $update['productName'],
                'description' => $update['description'],
                'status' => $update['status'],
            ];
            $productUpdate = Lib::trimInput($productUpdate);

            $product = $this->product->updateProduct($productUpdate,$id);

            if($product){
                $pd = $pe = [];

                // delete previously added department
                $this->productDepartment->deleteProductDepartment($id);

                // insert new data
                foreach ($update['department'] as $key => $value) {
                    $pd[$key] = new ProductDepartment();
                    $pd[$key]['department_id'] = $value;
                }
                if(!empty($pd)){
                    $pdSucc = $this->product->saveDepartment($pd,$id);
                    if($pdSucc){

                        // delete previously added experts
                        $this->productExpert->deleteProductExpert($id);
                        // insert new data
                        foreach ($update['employee'] as $key => $value) {
                            $pe[$key] = new ProductExpert();
                            $pe[$key]['employee_id'] = $value;
                        }

                        $peSucc = $this->product->saveProductExpert($pe,$id);
                        if($peSucc){
                            $response['success'] = 1;
                            DB::commit();
                        }else{
                            DB::rollback();
                        }
                    }else{
                        DB::rollback();
                    }
                }
            }else{
                DB::rollback();
            }

        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function saveProductCategory($input)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get("messages.PROCESS_FAIL"),
            ];

            $seesionuser = Sentinel::getUser();

            $input = Lib::trimInput($input);

            $insert = [
                'name' => $input['name'],
                'product_id' => $input['product'],
                'description' => $input['description'],
                'status' => $input['status'],
                'created_by_id' =>  $seesionuser->id,
                'updated_by_id' =>  $seesionuser->id,
            ];

            $insertSucc = $this->productCategory->saveProductCategory($insert);
            if(count($insertSucc)){
                $response['success'] = 1;
                unset($response['data']);
            }
        } catch (Exception $e) {
            $response['data'] = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function saveProductSubcategory($input)
    {
        
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get("messages.PROCESS_FAIL"),
            ];

            DB::beginTransaction();

            $seesionuser = Sentinel::getUser();

            $input = Lib::trimInput($input);

            $insert = [
                'name' => $input['name'],
                'product_category_id' => $input['productCategory'],
                'description' => $input['description'],
                'status' => $input['status'],
                'created_by_id' =>  $seesionuser->id,
                'updated_by_id' =>  $seesionuser->id,
            ];

            $insertSucc = $this->productSubcategory->saveProductSubcategory($insert);
            if(count($insertSucc)){
                // now update has_subcategory part
                $update['has_subcategory'] = 'Y';
                $succ  = $this->productCategory->updateProductCategory($update,$input['productCategory']);
                if($succ){
                    DB::commit();
                    $response['success'] = 1;
                    unset($response['data']);
                }else{
                    DB::rollback();
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = $e->getMessage();
        }finally{
            return $response;
        }
    }

    public function updateProductSubcategory($input,$id)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get("messages.PROCESS_FAIL"),
            ];

            $seesionuser = Sentinel::getUser();

            $input = Lib::trimInput($input);

            $update = [
                'name' => $input['name'],
                'product_category_id' => $input['productCategory'],
                'description' => $input['description'],
                'status' => $input['status'],
                'updated_by_id' =>  $seesionuser->id,
            ];

            $updateSucc = $this->productSubcategory->updateProductSubcategory($update,$id);
            if($updateSucc){
                $response['success'] = 1;
                unset($response['data']);
            }
        } catch (Exception $e) {
            $response['data'] = $e->getMessage();
        }finally{
            return $response;
        }
    }
    public function getAllProductCategories($input)
    {
        $input = Lib::trimInput($input);

        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $data = $this->productCategory->getAllProductCategories($input);
        return $data;
    }

    public function getAllProductSubcategories($input)
    {
        
        $input = Lib::trimInput($input);

        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $data = $this->productSubcategory->getAllProductSubcategories($input);
        return $data;
    }

    public function getProductCategoryById($productCategoryId)
    {
        return $this->productCategory->getProductCategoryById($productCategoryId);
    }

    public function getProductSubcategoryById($productSubcateogryId)
    {
        return $this->productSubcategory->getProductSubcategoryById($productSubcateogryId);
    }

    public function updateProductCategory($input,$id)
    {
        try {
            $response = [
                'success' => 0,
                'data' => Lang::get("messages.PROCESS_FAIL"),
            ];

            $seesionuser = Sentinel::getUser();

            $input = Lib::trimInput($input);

            $update = [
                'name' => $input['name'],
                'product_id' => $input['product'],
                'description' => $input['description'],
                'status' => $input['status'],
                'updated_by_id' =>  $seesionuser->id,
            ];

            $updateSucc = $this->productCategory->updateProductCategory($update,$id);
            if($updateSucc){
                $response['success'] = 1;
                unset($response['data']);
            }
        } catch (Exception $e) {
            $response['data'] = $e->getMessage();
        }finally{
            return $response;
        }
    }
   /* public function getProductDataForExcel()
    {
        $data = [];
        $molds = $this->product->getAllProducts();
        if(!empty($molds)){
            $supportData = $this->getAllData();
            $keys = ['Id', 'Trade Name','Type','Store','Group','Drawing','Color','Brand','Primary Application','Status'];
            array_push($data, $keys);
            
            foreach ($molds as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                $value['type_id'] = @$supportData['type'][$value['type_id']];
                $value['store_id'] = @$supportData['store'][$value['store_id']];
                $value['group_id'] = @$supportData['group'][$value['group_id']];
                $value['drawing_id'] = @$supportData['drawing'][$value['drawing_id']];
                $value['color_id'] = @$supportData['color'][$value['color_id']];
                $value['brand_id'] = @$supportData['brand'][$value['brand_id']];
                $value['primary_application_id'] = @$supportData['primaryApplication'][$value['primary_application_id']];
                $value['status'] = $supportData['status'][$value['status']];
                array_push($data, $value);
            }
        }
        return $data;
        
    }*/
}