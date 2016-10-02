<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\RoleService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Dto\SearchRoleDTO;
use ksec\Dto\RoleDTO;

class RoleController extends Controller
{
    public function __construct(RoleService $roleService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleService->getRoles();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $role = $this->roleService->getRoleById($id);
        if($id == Config::get('global_vars.ADMIN_ROLE_ID')) //added my mamta for admin edit restriction
        {
            return redirect('roles')->with('message',Lang::get('messages.not_allowed_to_edit'))->with('class','alert alert-danger');
        }
        $roleArr=json_decode($role);
        $cont=array();
        foreach($roleArr->permissions as $k => $v) 
        {
            $roleteArray  = explode(".",$k);
            if(isset($roleteArray[1])) {
                $cont[$roleteArray[0]][]=$roleteArray[1];
            }
        }
           
        if (is_null($role)) {
            return redirect('roles');
        }
        $searchRoleDTO = new SearchRoleDTO();
        $searchRoleDTO->setName($role->name);
        $searchRoleDTO->setSlug($role->slug);
        $searchRoleDTO->setId($role->id);
        $searchRoleDTO->setPermission($cont);
               
        $roleArray = Config::get('global_vars.DEFAULT_PERMISSIONS');
       
        $cont=array();
        foreach($roleArray as $k => $v) {
            $roleteArray  = explode(".",$k);
            if(!empty($roleteArray[1]))
            {
                $cont[$roleteArray[0]][]=$roleteArray[1];
            } else {
              //  $cont[$roleteArray[0]][]="0";
            }
        }

        $searchRoleDTO->setDefaultPermission($cont);

        $roleDTO = new RoleDTO();
        $roleDTO->setSearchRoleDTO($searchRoleDTO);
     
        return view('roles.edit', compact('roleDTO'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = Request::all();
        $result = $this->roleService->updateRole($input,$id);
        if($result){
            return redirect('roles')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');
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
