<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\NeckSizeService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\NeckSizeRequest;

class NeckSizeController extends Controller
{
    public function __construct(NeckSizeService $necksizeService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        
        $this->necksizeService  = $necksizeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $status = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));

        $neckSizes = $this->necksizeService->getNeckSizes($input);
        return view('neckSize.index',compact('neckSizes','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status = Config::get('global_vars.STATUS_ARR');
        return view('neckSize.create',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(NeckSizeRequest $necksizeRequest)
    {
        $input = Request::all();
        $this->necksizeService->saveNeckSize($input);
        return redirect('neckSize')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $necksize = $this->necksizeService->getNeckSize($id);
        $status = Config::get('global_vars.STATUS_ARR');
        return view('neckSize.edit',compact('necksize','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(NeckSizeRequest $necksizeRequest, $id)
    {
        $input = Request::all();
        $this->necksizeService->updateNeckSize($input,$id);
        return redirect('neckSize')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->necksizeService->deleteNeckSize($id);
        if($result['success'] == 1)
            return redirect('neckSize')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        else
            return redirect('neckSize')->with('message',$result['data'])->with('class','alert alert-danger');

    }
}
