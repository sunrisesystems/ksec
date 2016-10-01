<?php

namespace ksec\Http\Controllers;


use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\ProductService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct(ProductService $productService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->productService->getAllData();
        $products = $this->productService->getProducts($input);
        return view('product.index',compact('data','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->productService->getAllData();
        return view('product.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ProductRequest $productRequest)
    {
        $input = Request::all();

        $this->productService->saveProduct($input);
        return redirect('product')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $data = $this->productService->getAllData();
        
        return view('product.edit',compact('product','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ProductRequest $productRequest, $id)
    {
        $input = Request::all();
        $product = $this->productService->updateProduct($input,$id);
        return redirect('product')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->productService->deleteProduct($id);
        if($result['success'] == 1){
            return redirect('product')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect('product')->with('message',$result['data'])->with('class','alert alert-danger');

        }
    }

    public function getExportToExcel()
    {
        $data = $this->productService->getProductDataForExcel();

        Excel::create("product-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('product', function($sheet) use($data) {

                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->row(1, function($row) {
                    $row->setFont([
                        'bold'       =>  true,
                        'size'       => '10',
                    ]);
                });
                $sheet->setAutoSize(true);
            });

        })->export('xls');
    }
}
