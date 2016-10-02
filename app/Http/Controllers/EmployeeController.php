<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\EmployeeService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Sentinel;
use ksec\Http\Requests\EmployeeRequest;
use ksec\Http\Requests\ResetPasswordRequest;

class EmployeeController extends Controller
{
    public function __construct(EmployeeService $employeeService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
      //  $this->middleware('acl');
        $this->employeeService = $employeeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->employeeService->getAllData();
        $employees = $this->employeeService->getAllEmployess($input);

        return view('employees.index',compact('data','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->employeeService->getAllData();
        return view('employees.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(EmployeeRequest $employeeRequest)
    {
        $input = $employeeRequest->all();

        $result = $this->employeeService->saveEmployee($input);
        if($result['success']){
            return redirect('employees')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $employee = $this->employeeService->getEmployeeById($id);
        if(count($employee)){
            $data = $this->employeeService->getAllData();
            return view('employees.edit',compact('data','employee'));
        }else{
            return redirect('employees')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-danger');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(EmployeeRequest $employeeRequest, $id)
    {
        $input = $employeeRequest->all();
        $result = $this->employeeService->updateEmployee($input,$id);
        if($result['success']){
            return redirect('employees')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');
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
        $user = Sentinel::findById($id);
        return view('users.resetPassword',compact('id','user'));   
    }

     public function postUpdatePassword(ResetPasswordRequest $resetPwdRequest)
    {
        $input = $resetPwdRequest->all();
        $result = $this->employeeService->resetPassword($input);
        if($result['success']){
            return redirect('users')->with('message',$result['data'])->with('class','alert alert-success');
        }else{
            return redirect('users')->with('message',$result['data'])->with('class','alert alert-danger');
        }
        //return view('users.resetPassword',compact('id'));   
    }


}
