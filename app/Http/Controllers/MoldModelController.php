<?php

namespace ksec\Http\Controllers;


use Request,Lang,Config;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\MoldService;
use ksec\Http\Requests\MoldModelRequest;
use ksec\Libraries\Lib;

class MoldModelController extends Controller
{
    public function __construct(MoldService $moldService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->moldService  = $moldService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $molds = $this->moldService->getMoldModels($input);
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return view('mold.index',compact('molds','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
