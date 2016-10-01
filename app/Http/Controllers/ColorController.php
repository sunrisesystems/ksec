<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\ColorService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\ColorRequest;

class ColorController extends Controller
{
    public function __construct(ColorService $colorService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->colorService = $colorService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $colors = $this->colorService->getColors($input);
        $status = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return view('colors.index',compact('colors','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status = Config::get('global_vars.STATUS_ARR');
        return view('colors.create',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ColorRequest $colorRequest)
    {
        $input = Request::all();
        $this->colorService->saveColor($input);
        return redirect('colors')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');

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
        $color = $this->colorService->getcolor($id);
        $status = Config::get('global_vars.STATUS_ARR');
        return view('colors.edit',compact('color','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ColorRequest $colorRequest, $id)
    {
        $input = Request::all();
        $this->colorService->updateColor($input,$id);
        return redirect('colors')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->colorService->deleteColor($id);
        if($result['success'] == 1){
            return redirect('colors')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect('colors')->with('message',$result['data'])->with('class','alert alert-danger');

        }
    }
}
