<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\TypeService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    public function __construct(TypeService $typeService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        
        $this->typeService  = $typeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->typeService->getData();
        $types = $this->typeService->getTypes($input);
        return view('types.index',compact('types','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->typeService->getData();
        return view('types.create',compact('data'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TypeRequest $typeRequest)
    {
        $input = Request::all();
        $this->typeService->saveType($input);
        return redirect('types')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $type = $this->typeService->getType($id);
        $data = $this->typeService->getData();
        
        return view('types.edit',compact('type','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(TypeRequest $typeRequest, $id)
    {
        $input = Request::all();
        $this->typeService->updateType($input,$id);
        return redirect('types')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->typeService->deleteType($id);
        if($result['success'] == 1)
            return redirect('types')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        else
            return redirect('types')->with('message',$result['data'])->with('class','alert alert-danger');

    }
}
