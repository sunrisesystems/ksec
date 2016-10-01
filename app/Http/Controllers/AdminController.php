<?php

namespace ksec\Http\Controllers;

use Request,Sentinel,Lang,Session,Config,Artisan;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\AdminService;
use ksec\Http\Requests\LoginRequest;
use ksec\Http\Requests\ChangePasswordRequest;
use ksec\Http\Requests\UpdateProfileRequest;
use ksec\Libraries\Lib;
use ksec\User;

class AdminController extends Controller
{
    public function __construct(AdminService $adminService, User $user)
    {
        $this->middleware('timeout');
        $this->adminService  = $adminService;
        $this->user = $user;
    }

    public function getLogin()
    {
        
        if (Sentinel::check())
        {
            return redirect('dashboard');
        }
        $units = $this->adminService->getUnitList();
       	return view('admin.login',compact('units'));
    }

    public function getHome()
    {
        return view('welcome');
    }

    public function postLogin(LoginRequest $loginRequest)
    {
        $input = $loginRequest->all();

        $credentials = [
            'username' => $input['username'],
            'unit_id' => $input['unit'],
            'password' => $input['password'],
            'status' => 'A',
        ];
     //var_dump($credentials);
        try {
            $timeZone = $this->adminService->getTimeZoneByUnitId($input['unit']);
            Session::put('timezone',$timeZone);
            date_default_timezone_set($timeZone);
            Config::set('app.timezone',$timeZone);
                
            if(isset($input['remeber']) && $input['remeber'] == 'Y'){
                // get time zone from unit
                $user = Sentinel::authenticateAndRemember($credentials);
            }else{
                $user = Sentinel::authenticate($credentials);
            }
     
            if($user){
                // set unit name in Session
                $unitName = $this->adminService->getUnitName(['unitId'=>Sentinel::getUser()->unit_id]);
                Session::put('unitName',$unitName['data']->unit_name);

                $role = $this->user->findById(Sentinel::getUser()->id);
                $role = $role->toArray();
                Session::put('userRole',$role['user_role']['role']['name']);
             //  dd(Sentinel::authenticate($credentials));
                $req = Session::get('uri');
                Session::forget('uri');
            
                if(!empty($req))
                {
                    return redirect($req);
                }
               // echo Config::get('app.timezone'); exit;
                return redirect('dashboard');
            }else{
                return redirect()->back()->withInput()->with('message',Lang::get('messages.LOGIN_FAILED'))->with('class','alert alert-danger');
            }
        } catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $e) {
            return redirect()->back()->withInput()->with('message',$e->getMessage())->with('class','alert alert-danger');
        }
        
    }

    public function getLogout()
    {
        $res = Sentinel::logout();
        return redirect('/')->with('message',Lang::get('messages.LOGOUT'))->with('class','alert alert-success');
    
    }

    public function getDownload($drawingId){
        $headers = array(
            'Content-Type' => 'application/pdf'
        );
        $filename = 'D_'.$drawingId.'.pdf';
        return response()->download(public_path().'/data/'.Config::get('global_vars.PRODUCT_TYPE.DRAWING_PRODUCT_TYPE').'/'.$drawingId.'/'.$filename ,$filename, $headers);
    }

    public function getDownloadAttachment($drawingId,$attachmentId)
    {
        $headers = array(
            'Content-Type' => 'application/pdf'
        );
        $filename = 'DA_'.$attachmentId.'.pdf';
        return response()->download(public_path().'/data/'.Config::get('global_vars.PRODUCT_TYPE.DRAWING_ATTACHMENT_PRODUCT_TYPE').'/'.$drawingId.'/'.$filename ,$filename, $headers);
    }

    public function getDeleteAttachment($attachmentId)
    {
        $data = $this->adminService->deleteAttachment($attachmentId);
        return response()->json($data);     
    }

    public function postGetUnit(){
        $input = Request::all();
        $data = $this->adminService->getUnitName($input);
        return response()->json($data);

    }

    public function getChangePassword()
    {
        return view('admin.changePassword');
    }

    public function postUpdatePassword(ChangePasswordRequest $changePwdRequest)
    {
        $input = $changePwdRequest->all();
        $result = $this->adminService->changePassword($input);
        if($result['success']){
            Sentinel::logout();
            return redirect('/')->with('message',Lang::get('messages.pwd_change_succ'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
       }
    }

    public function getProfile()
    {
        $user = \Sentinel::getUser();
        return view('admin.profile',compact('user'));
    }

    public function postUpdateProfile(UpdateProfileRequest $updateProfileRequest)
    {
        $input = $updateProfileRequest->all();
        $result = $this->adminService->updateProfile($input);
        return redirect()->back()->with('message',$result['data'])->with('class',$result['class']);

    }

    public function getShutDown()
    {
        Artisan::call('down', array());
    }

    public function getUp()
    {
        Artisan::call('up', array());
    }
}
