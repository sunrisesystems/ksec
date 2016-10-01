<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\ShapeService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\ShapeRequest;


class ShapesController extends Controller
{
    public function __construct(ShapeService $shapeService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->shapeService = $shapeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $shapes = $this->shapeService->getShapes($input);
        $status = Lib::addSelect(Config::get("global_vars.STATUS_ARR"));
        return view('shapes.index',compact('shapes','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status = Config::get('global_vars.STATUS_ARR');
        return view('shapes.create',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ShapeRequest  $shapeRequest
     * @return Response
     */
    public function store(ShapeRequest $shapeRequest)
    {
        $input = Request::all();

        $this->shapeService->saveShape($input);
        return redirect('shapes')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $shape = $this->shapeService->getShapeById($id);
        $status = Config::get('global_vars.STATUS_ARR');

        return view('shapes.edit',compact('shape','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ShapeRequest $shapeRequest, $id)
    {
        $input = Request::all();
        $shape = $this->shapeService->updateShape($input,$id);
        return redirect('shapes')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->shapeService->deleteShape($id);
        if($result['success']){
            return redirect('shapes')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success'); 
        }else{
            return redirect('shapes')->with('message',$result['data'])->with('class','alert alert-danger'); 
        }
        
    }
}
