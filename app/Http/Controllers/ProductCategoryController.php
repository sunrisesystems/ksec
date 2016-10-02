<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Services\ProductService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
     public function __construct(ProductService $productService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
//        $this->middleware('acl');
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->productService->getAllProdcutCategoryDataForIndex();
        $productCategories = $this->productService->getAllProductCategories($input);
        return view('productCategory.index',compact('data','productCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->productService->getAllProdcutCategoryData();
        return view('productCategory.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $productCategoryRequest)
    {
        $input = Request::all();

        $result = $this->productService->saveProductCategory($input);

        if($result['success']){
            return redirect('product-category')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productCategory = $this->productService->getProductCategoryById($id);
        $data = $this->productService->getAllProdcutCategoryData();
        if(count($productCategory)){
            return view('productCategory.edit',compact('productCategory','data'));
        }else{
            return redirect('product-category')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-info');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $productCategoryRequest, $id)
    {
        $input = Request::all();
        $result = $this->productService->updateProductCategory($input,$id);
        if($result['success']){
            return redirect('product-category')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
