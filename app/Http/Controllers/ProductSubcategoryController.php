<?php

namespace cvmapp\Http\Controllers;

use cvmapp\Http\Requests;
use cvmapp\Http\Controllers\Controller;
use cvmapp\Services\ProductService;
use cvmapp\Libraries\Lib;

use Request,Lang,Config,Excel;
use cvmapp\Http\Requests\ProductSubcategoryRequest;

class ProductSubcategoryController extends Controller
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
        $data = $this->productService->getAllProductSubcategoryDataForIndex();
        $productSubcategories = $this->productService->getAllProductSubcategories($input);
        return view('productSubcategory.index',compact('data','productSubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->productService->getAllProductSubcategoryData();
        return view('productSubcategory.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSubcategoryRequest $productSubcategoryRequest)
    {
        $input = $productSubcategoryRequest->all();

        $result = $this->productService->saveProductSubcategory($input);

        if($result['success']){
            return redirect('product-subcategory')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $productSubcategory = $this->productService->getProductSubcategoryById($id);
        $data = $this->productService->getAllProductSubcategoryData();
        if(count($productSubcategory)){
            return view('productSubcategory.edit',compact('productSubcategory','data'));
        }else{
            return redirect('product-subcategory')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-info');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductSubcategoryRequest $productSubcategoryRequest, $id)
    {
        $input = $productSubcategoryRequest->all();

        $result = $this->productService->updateProductSubcategory($input,$id);

        if($result['success']){
            return redirect('product-subcategory')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
