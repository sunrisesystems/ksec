<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\GroupService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\GroupRequest;


class GroupController extends Controller
{
    public function __construct(GroupService $groupService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        
        $this->groupService  = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $status = Lib::addSelect(Config::get("global_vars.STATUS_ARR"));
        $groups = $this->groupService->getGroups($input);
        return view('groups.index',compact('groups','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status = Config::get('global_vars.STATUS_ARR');
        return view('groups.create',compact('status'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(GroupRequest $groupRequest)
    {
        $input = Request::all();
        $this->groupService->saveGroup($input);
        return redirect('groups')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $group = $this->groupService->getGroup($id);
        $status = Config::get('global_vars.STATUS_ARR');
        return view('groups.edit',compact('group','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(GroupRequest $groupRequest, $id)
    {
        $input = Request::all();
        $this->groupService->updateGroup($input,$id);
        return redirect('groups')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->groupService->deleteGroup($id);
        return redirect('groups')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');

    }
}
