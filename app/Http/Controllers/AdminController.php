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
use ksec\Employee;

class AdminController extends Controller
{
    public function __construct(AdminService $adminService, Employee $employee)
    {
        $this->middleware('timeout');
        $this->adminService  = $adminService;
        $this->employee = $employee;
    }

    public function getLogin()
    {

        /*$credentials = [
            'system_id'    => '123456',
            'password' => 'Idfc@2016',
            'department_id' => 1,
            'emp_type_id' => 1,
        ];

        $user = Sentinel::registerAndActivate($credentials);

        $role = Sentinel::findRoleBySlug('admin');

        $role->users()->attach($user);
*/
        if (Sentinel::check())
        {
            return redirect('dashboard');
        }
       	return view('admin.login');
    }

    public function postLogin(LoginRequest $loginRequest)
    {
        $input = $loginRequest->all();
        
        $credentials = [
            'system_id' => $input['systemId'],
            'password' => $input['password'],
            'status' => 'A',
            'allow_login' => 'Y',
        ];
    
        try {
             
            if(isset($input['remeber']) && $input['remeber'] == 'Y'){
                $employee = Sentinel::authenticateAndRemember($credentials);
            }else{
                
                $employee = Sentinel::authenticate($credentials);

            }
            
            $req = Session::get('uri');
            Session::forget('uri');
           
            if($employee){
                $role = $this->employee->findById(Sentinel::getUser()->id);
                
                $role = $role->toArray();
                Session::put('userRole',$role['user_role']['role']['name']);
                
                if(!empty($req))
                {
                    return redirect($req);
                }
               
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
