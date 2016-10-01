<?php

namespace ksec\Http\Controllers;

use Illuminate\Http\Request;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\TransactionService;
use ksec\Libraries\Lib;
use Lang,Sentinel;

class DailyEntryController extends Controller
{

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $data = $this->transactionService->getAllData();
        $dailyEntry = $this->transactionService->getDailyEntryData($input);
        return view('dailyEntry.index',compact('data','dailyEntry'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $shifts = $this->transactionService->getShifts();
        return view('dailyEntry.add',compact('shifts'));
    }

    public function destroy($id)
    {
        $result = $this->transactionService->deleteDailyEntry($id);
        if($result['success'])
            return redirect('dailyEntry')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        else 
            return redirect('dailyEntry')->with('message',$result['data'])->with('class','alert alert-danger');
    }

    public function postLoadAllMachines(Request $request)
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
        $result = $this->transactionService->loadAllMachines($input);
        return view('dailyEntry.machines',compact('result'));
    }

    public function postSaveDailyEntry(Request $request)
    {
        //Lib::pr($request->all()); exit;
        $input = $request->all();
        $result = $this->transactionService->saveDailyEntry($input);
        if($result['success']){
            return redirect('dailyEntry')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->withInput()->with('message',$result['msg'])->with('class','alert alert-danger');
        }
    }

    public function postGetRejection(Request $request)
    {
        $input = $request->all();
        $rejectionData = $this->transactionService->getRejection($input);
        return view('dailyEntry.rejection',compact('rejectionData'));

    }

    public function postGetDowntime(Request $request)
    {
        $input = $request->all();
        $downtimeData = $this->transactionService->getDowntime($input);
        return view('dailyEntry.downtime',compact('downtimeData'));

    }

    public function postSaveRejection(Request $request)
    {
        $input = $request->all();
        $result = $this->transactionService->saveRejection($input);
        return response()->json($result);
    }

    public function postSaveDowntime(Request $request)
    {
        $input = $request->all();
        $result = $this->transactionService->saveDowntime($input);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $result = $this->transactionService->showDailyEntry($id);
        if($result['success']){
            return view('dailyEntry.show',compact('result'));
        }else{
            return redirect()->back()->withInput()->with('message',$result['msg'])->with('class','alert alert-danger');
        }
    }

    public function getShowDailyEntry()
    {
        $shifts = $this->transactionService->getShifts();
        return view('dailyEntry.show',compact('shifts'));
    }

    public function postShowDailyEntry(Request $request)
    {
        $user = Sentinel::getUser();
        $this->validate($request, [
            'date' => 'required|date_format:d-m-Y|before:tomorrow',
            'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
        ]);
        $input = $request->all();
        $result = $this->transactionService->loadAllMachinesForView($input);
        return view('dailyEntry.showMachines',compact('result'));
    }

}
