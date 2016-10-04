<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\CallService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\CallTypeRequest;


class CalltypeController extends Controller
{
     public function __construct(CallService $callService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
//        $this->middleware('acl');
        $this->callService = $callService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->callService->getCallTypeAllData();
        $callTypes = $this->callService->getCallTypes($input);
        return view('callType.index',compact('data','callTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->callService->getCallTypeAllData();
        return view('callType.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CallTypeRequest $request)
    {
        $input = $request->all();
      
        $result = $this->callService->saveCallType($input);

        if($result['success']){
            return redirect('calltype')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $callType = $this->callService->getCallTypeById($id);
        $data = $this->callService->getCallTypeAllData();
        if(count($callType)){
            return view('callType.edit',compact('callType','data'));
        }else{
            return redirect('callType')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-info');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CallTypeRequest $request, $id)
    {
        $input = $request->all();

        $result = $this->callService->updateCallType($input,$id);
        if($result['success']){
            return redirect('calltype')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
