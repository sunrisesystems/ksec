<?php

namespace ksec\Http\Controllers;


use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\CodeService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\CodeRequest;

class CodevalueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(CodeService $codeService)
    {
         $this->middleware('sentinel');
         $this->middleware('timeout');
         $this->middleware('acl');
        $this->codeService = $codeService;
    }

    public function index()
    {
        $input = Request::all();
        $data = $this->codeService->getData();
        $codeValues = $this->codeService->getCodeValues($input);
        return view('codeValue.index',compact('data','codeValues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->codeService->getData();
        return view('codeValue.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CodeRequest $codeRequest)
    {
        $input = Request::all();
        $this->codeService->saveCodeValue($input);
        return redirect('codeValue')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');

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
        $codeValue = $this->codeService->getCodeValue($id);
        $data = $this->codeService->getData();
        return view('codeValue.edit',compact('codeValue','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CodeRequest $codeRequest, $id)
    {
        $input = Request::all();
        $this->codeService->updateCodeValue($input,$id);
        return redirect('codeValue')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->codeService->deleteCodeValue($id);
        if($result['success'] == 1){
            return redirect('codeValue')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect('codeValue')->with('message',$result['data'])->with('class','alert alert-danger');

        }
    }
}
