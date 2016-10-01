<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\MachineService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\MachineModelRequest;

class MachineModelController extends Controller
{
    public function __construct(MachineService $machineService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->machineService = $machineService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $machineModels = $this->machineService->getMachineModels($input);
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return view('machineModel.index',compact('machineModels','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->machineService->getMachineModelData();
        return view('machineModel.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(MachineModelRequest $machineModelRequest)
    {
        $input = Request::all();
        $imageData = [];
        if(Request::hasFile('attachments')){
            $imageData['attachments'] = Request::file('attachments');   
        }else{
            $imageData['attachments'] = '';
        }
        $result = $this->machineService->saveMachineModel($input,$imageData);
        if($result)
            return redirect('machineModel')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        else
            echo "in else";
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
        $data = $this->machineService->getMachineModelData();
        $machineModel = $this->machineService->getMachineModelById($id);
        return view('machineModel.edit',compact('data','machineModel')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(MachineModelRequest $machineModelRequest, $id)
    {
        $input = Request::all();
        $imageData = [];
        if(Request::hasFile('attachment_file')){
            $imageData['attachmentFile'] = Request::file('attachment_file');   
        }else{
            $imageData['attachmentFile'] = '';
        }

        if(Request::hasFile('attachments')){
            $imageData['attachments'] = Request::file('attachments');   
        }else{
            $imageData['attachments'] = '';
        }
        $result = $this->machineService->updateMachineModel($input,$imageData,$id);
        if($result)
            return redirect('machineModel')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        else
            echo "in else";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $machineModel = $this->machineService->deleteMachineModel($id);
        return redirect('drawings')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success'); 
        
    }

    public function getExportToExcel()
    {
        $data = $this->machineService->getMachineModelDataForExcel();

        Excel::create("machineModel-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('machineModel', function($sheet) use($data) {

                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->row(1, function($row) {
                    $row->setFont([
                        'bold'       =>  true,
                        'size'       => '10',
                    ]);
                });
                $sheet->setAutoSize(true);
            });

        })->export('xls');
    }
}
