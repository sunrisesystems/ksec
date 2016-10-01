<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\MachineService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\MachineRequest;


class MachineController extends Controller
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
        $machines = $this->machineService->getMachines($input);
        $data = $this->machineService->getMachineData();
        return view('machine.index',compact('machines','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->machineService->getMachineData();
        return view('machine.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(MachineRequest $machineRequest)
    {
        $input = Request::all();
        $this->machineService->saveMachine($input);
        return redirect('machine')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $machine = $this->machineService->getMachine($id);
        $data = $this->machineService->getMachineData();
        return view('machine.edit',compact('machine','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(MachineRequest $machineRequest, $id)
    {
        $input = Request::all();
        $result = $this->machineService->updateMachine($input,$id);
        if($result)
            return redirect('machine')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        else
            return redirect()->back()->withInput()->with('message',Lang::get('messages.ERROR'))->with('class','alert alert-danger');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->machineService->deleteMachine($id);
        return redirect('machine')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');

    }

    public function getExportToExcel()
    {
        $data = $this->machineService->getMachineDataForExcel();

        Excel::create("machine-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('machine', function($sheet) use($data) {

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
