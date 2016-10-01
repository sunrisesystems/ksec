<?php

namespace ksec\Http\Controllers;
use Illuminate\Http\Request;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\DefectService;
use ksec\Services\TransactionService;
use ksec\Libraries\Lib;

use Lang,Config,Excel,Sentinel;

class RejectionController extends Controller
{
    public function __construct(TransactionService $transactionService)
    {
        $this->middleware('sentinel');
        $this->middleware('acl');
        $this->middleware('timeout');
        $this->transactionService = $transactionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(Request $request)
    {
        $input = $request->all();
        $shifts = $this->transactionService->getShifts();
        $source = Lib::addSelect(Config::get('global_vars.REJECTION_SOURCE'));
        $rejectionData = $this->transactionService->getRejectionDetailData($input);
        return view('rejection.index',compact('shifts','rejectionData','source'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $shifts = $this->transactionService->getShifts();
        $source = Lib::addSelect(Config::get('global_vars.REJECTION_SOURCE'));
        return view('rejection.create',compact('shifts','source'));
    }
	
    public function getShow()
    {
        $shifts = $this->transactionService->getShifts();
        $source = Lib::addSelect(Config::get('global_vars.REJECTION_SOURCE'));
        return view('rejection.show',compact('shifts','source'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postDeleteRejectionEntry($id)
    {
        $result = $this->transactionService->deleteRejectionEntry($id);
        if($result['success'])
            return redirect()->back()->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');
        else 
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
    }

    public function postLoadRejectionSlip(Request $request)
    {
        $user = Sentinel::getUser();
        if(Lib::isAdmin()){
            $this->validate($request, [
                'date' => 'required|date_format:d-m-Y',
                'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
                'source' => 'required|in:PROD,CUST',
            ]);
        }else{
            $this->validate($request, [
                'date' => 'required|date_format:d-m-Y|after:yesterday|before:tomorrow',
                'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
                'source' => 'required|in:PROD,CUST',
            ]);
        }
        $input = $request->all();
        $result = $this->transactionService->loadRejectionSlip($input);
        if($input['source'] == 'PROD'){
            return view('rejection.productionRejection',compact('result'));
        }else{
            return view('rejection.customerRejection',compact('result'));
        }
    }

    public function postSaveCustomerRejection(Request $request)
    {
        $input = $request->all();
        $result = $this->transactionService->saveCustomerRejection($input);
        return response()->json($result);
    }

    public function postSaveProductionRejection(Request $request)
    {
        $input = $request->all();
        $result = $this->transactionService->saveProductionRejection($input);
        return response()->json($result);
    }

    public function postShowRejectionData(Request $request)
    {
        $user = Sentinel::getUser();
        $this->validate($request, [
            'date' => 'required|date_format:d-m-Y|before:tomorrow',
            'shift' => 'required|exists:shifts,id,unit_id,'.$user->unit_id,
            'source' => 'required|in:CUST,PROD',
        ]);
        $input = $request->all();
        $result = $this->transactionService->showRejectionData($input);
        return view('rejection.showRejectionEntry',compact('result'));
    }
}
