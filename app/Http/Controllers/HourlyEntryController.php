<?php

namespace ksec\Http\Controllers;

use Illuminate\Http\Request;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\TransactionService;
use ksec\Libraries\Lib;
use Sentinel,Lang,URL,Session;

class HourlyEntryController extends Controller
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
    	$hourlyEntryData = [];
    	$input = $request->all();
        $shifts = $this->transactionService->getShifts();
        if(!empty($input)){
        	$hourlyEntryData = $this->transactionService->getHoulyEntryData($input);
        }
        return view('hourlyEntry.index',compact('shifts','hourlyEntryData','input'));
    }

    public function getCreate()
    {
        $shifts = $this->transactionService->getShifts();
        $shifitTimings = $this->transactionService->getShiftTiminings();
        return view('hourlyEntry.add',compact('shifts','shifitTimings'));
    }

    public function postLoadAllHourlyData(Request $request)
    {
    	$user = Sentinel::getUser();
        if(Lib::isAdmin()){
            $this->validate($request, [
                'date' => 'required|date_format:d-m-Y',
                'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
                'time' => 'required|date_format:H:i',
            ]);
        }else{
            $this->validate($request, [
                'date' => 'required|date_format:d-m-Y|after:yesterday|before:tomorrow',
                'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
                'time' => 'required|date_format:H:i',
            ]);
        }
        $input = $request->all();
        $result = $this->transactionService->loadHourlyEntryData($input);
        return view('hourlyEntry.hourlyEntry',compact('result'));
    }

    public function postSaveHourlyEntryData(Request $request)
    {
        $input = $request->all();
        $result = $this->transactionService->saveHourlyEntryData($input);
        return response()->json($result);
        
    }

    public function getEdit($id)
    {
        Session::put('hourlyEntryRedirection',URL::previous());
        $result = $this->transactionService->getHourlyEntryById($id);
        if($result['success']){
        	return view('hourlyEntry.edit',compact('result'));
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
        }
    }

    public function postDeleteHourlyEntry($id)
    {
        $result = $this->transactionService->deleteHourlyEntry($id);
        if($result['success'])
            return redirect()->back()->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        else 
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
    }

    public function getShow($id)
    {
        Session::put('hourlyEntryShowRedirection',URL::previous());
        $result = $this->transactionService->getHourlyEntryById($id,1);
        if($result['success']){
            return view('hourlyEntry.show',compact('result'));
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
        }
    }

}
