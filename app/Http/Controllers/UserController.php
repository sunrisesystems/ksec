<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\UserService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\UserRequest;
use ksec\Http\Requests\ResetPasswordRequest;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->userService->getAllData();
        $users = $this->userService->getAllUsers($input);
        return view('users.index',compact('data','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->userService->getAllData();
        return view('users.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserRequest $userRequest)
    {
        $input = $userRequest->all();
        $result = $this->userService->saveUser($input);
        if($result['success']){
            return redirect('users')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
        }

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
        $user = $this->userService->getUserById($id);
        if(count($user)){
            $data = $this->userService->getAllData();
            return view('users.edit',compact('data','user'));
        }else{
            return redirect('users')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-danger');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $userRequest, $id)
    {
        $input = $userRequest->all();
        $result = $this->userService->updateUser($input,$id);
        if($result['success']){
            return redirect('users')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
        }
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

    public function getResetPassword($id)
    {
        $user = \Sentinel::findById($id);
        return view('users.resetPassword',compact('id','user'));   
    }

     public function postUpdatePassword(ResetPasswordRequest $resetPwdRequest)
    {
        $input = $resetPwdRequest->all();
        $result = $this->userService->resetPassword($input);
        if($result['success']){
            return redirect('users')->with('message',$result['data'])->with('class','alert alert-success');
        }else{
            return redirect('users')->with('message',$result['data'])->with('class','alert alert-danger');
        }
        //return view('users.resetPassword',compact('id'));   
    }


}
