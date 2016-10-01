<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\PlanningService;
use ksec\Libraries\Lib;

use Request,Lang,Config;
use ksec\Http\Requests\PlanningRequest;

class PlanningController extends Controller
{
    public function __construct(PlanningService $planningService)
    {
        $this->middleware('sentinel');
        $this->middleware('acl');
        $this->middleware('timeout');
        $this->planningService = $planningService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $input = Request::all();
        $data = $this->planningService->getSearchData();
        $plannings = $this->planningService->getPlannings($input);
        return view('planning.index',compact('data','plannings'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $data = $this->planningService->getAllData();
        return view('planning.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function postAddPlanning(PlanningRequest $planningRequest)
    {
        $input = Request::all();
        $result = $this->planningService->savePlanning($input);
        if($result['success']){
            return redirect('planning')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->withInput()->with('message',$result['msg'])->with('class','alert alert-danger');

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
    public function getEdit($id)
    {
        // check for plan status and then allow to edit if status == 'A'
        $allowEdit = $this->planningService->checkForActiveStatus($id);
        if($allowEdit){
            $plan = $this->planningService->getPlanning($id);
            $data = $this->planningService->getAllData($plan->toArray());
            //Lib::pr($plan->toArray()); exit;
            return view('planning.edit',compact('data','plan'));
        }else{
            return redirect('planning')->with('message',Lang::get('messages.not_allow_to_edit_plan'))->with('class','alert alert-danger');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function postUpdate(PlanningRequest $planningRequest, $id)
    {
        $input = Request::all();
        $result = $this->planningService->updatePlanning($input,$id);
        if($result['success']){
            return redirect('planning')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->withInput()->with('message',$result['data'])->with('class','alert alert-danger');

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

    public function postGetMolds()
    {
        $input = Request::all();
        $result = $this->planningService->getMoldByProduct($input['productId']);
        return view('planning.mold',compact('result'));
    }

    public function postGetProducts()
    {
        $input = Request::all();
        $result = $this->planningService->getProductByMold($input['moldId']);
        //return view('planning.product',compact('result'));
        return response()->json($result);

    }

    public function postGetPlanningForMachine()
    {
        $input = Request::all();
        $planning = $this->planningService->getPlanningForMachine($input['machineId']);
        $machine = $this->planningService->getMachines();
        return view('planning.planning',compact('planning','machine'));
    }

    public function postCheckPlanDate()
    {
        $input = Request::all();
        $result = $this->planningService->checkPlanDate($input);
        return response()->json($result);
    }

    public function postCalculateTime()
    {
        $input = Request::all();
        $result = $this->planningService->calculateTime($input);
        return response()->json($result);
    }
}
