<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\StoreService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\StoreRequest;

class StoresController extends Controller
{
    public function __construct(StoreService $storeService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        
        $this->storeService  = $storeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $stores = $this->storeService->getStores($input);
        $status = Lib::addSelect(Config::get("global_vars.STATUS_ARR"));
        return view('stores.index',compact('stores','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status = Config::get('global_vars.STATUS_ARR');
        return view('stores.create',compact('status')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(StoreRequest $storeRequest)
    {
        $input = Request::all();
        $this->storeService->saveStore($input);
        return redirect('stores')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $store = $this->storeService->getStore($id);
        $status = Config::get('global_vars.STATUS_ARR');
        return view('stores.edit',compact('store','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(StoreRequest $storeRequest, $id)
    {
        $input = Request::all();
        $this->storeService->updateStore($input,$id);
        return redirect('stores')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->storeService->deleteStore($id);
        if($result['success']){
            return redirect('stores')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect('stores')->with('message',$result['data'])->with('class','alert alert-danger'); 
        }
        

    }
}
