<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\AccountService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\AccountRequest;

class AccountController extends Controller
{
    public function __construct(AccountService $accountService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        
        $this->accountService  = $accountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $accounts = $this->accountService->getAccounts($input);
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return view('accounts.index',compact('accounts','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['status'] = Config::get('global_vars.STATUS_ARR');
        return view('accounts.create',compact('data')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AccountRequest $accountRequest)
    {
        $input = Request::all();
        $this->accountService->saveAccount($input);
        return redirect('accounts')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $account = $this->accountService->getAccount($id);
        $data['accountType'] = $this->accountService->getAccountType();
        $data['status'] = Config::get('global_vars.STATUS_ARR');
        return view('accounts.edit',compact('account','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AccountRequest $accountRequest, $id)
    {
        $input = Request::all();
        $this->accountService->updateAccount($input,$id);
        return redirect('accounts')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = $this->accountService->deleteAccount($id);
        if($result['success']){
            return redirect('accounts')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect('accounts')->with('message',$result['data'])->with('class','alert alert-danger'); 
        }
    }
}
