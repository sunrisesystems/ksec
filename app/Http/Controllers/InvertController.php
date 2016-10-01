<?php

namespace ksec\Http\Controllers;
use Illuminate\Http\Request;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\TransactionService;
use ksec\Libraries\Lib;

use Lang,Config,Sentinel;

class InvertController extends Controller
{
    public function __construct(TransactionService $transactionService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->transactionService = $transactionService;
    }

    public function getIndex(Request $request)
    {
        $input = $request->all();
        $data = $this->transactionService->getAllData();
        $invertData = $this->transactionService->getInvertDetailData($input);
        return view('invert.index',compact('data','invertData'));
    }

    public function getCreate()
    {
        $shifts = $this->transactionService->getShifts();
        return view('invert.add',compact('shifts'));
    }

    public function getShow()
    {
        $shifts = $this->transactionService->getShifts();
        return view('invert.show',compact('shifts'));
    }

    public function postLoadAllInvert(Request $request)
    {
    	$user = Sentinel::getUser();
        if(Lib::isAdmin()){
            $this->validate($request, [
                'date' => 'required|date_format:d-m-Y',
                'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
            ]);
        }else{
            $this->validate($request, [
                'date' => 'required|date_format:d-m-Y|after:yesterday|before:tomorrow',
                'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
            ]);
        }
       
        $input = $request->all();
        $result = $this->transactionService->loadAllFgInvert($input);
        return view('invert.invertEntry',compact('result'));
    }

    public function postShowInvertData(Request $request)
    {
        $user = Sentinel::getUser();
        $this->validate($request, [
            'date' => 'required|date_format:d-m-Y|before:tomorrow',
            'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
        ]);
        $input = $request->all();
        $result = $this->transactionService->showAllFgInvert($input);
        return view('invert.showInvertEntry',compact('result'));
    }

    public function postGetQuantityPerBox(Request $request)
    {
        $input = $request->all();
        $result = $this->transactionService->getQuantityPerBox($input);
        return response()->json($result);
    }

    public function postSaveInvertData(Request $request)
    {
        $input = $request->all();
        $result = $this->transactionService->saveInvertData($input);
        if($result['success']){
            return redirect('invert')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->withInput()->with('message',$result['msg'])->with('class','alert alert-danger');
        }
    }

    public function postGetTypeOfPacking(Request $request)
    {
        $input = $request->all();
        $result = $this->transactionService->getTypeOfPacking($input);
        return response()->json($result);
    }
}
