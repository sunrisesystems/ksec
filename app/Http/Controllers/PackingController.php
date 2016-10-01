<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\PackingService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\PackingRequest;

class PackingController extends Controller
{
    public function __construct(PackingService $packingService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->packingService = $packingService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->packingService->getAllData();
        $packing = $this->packingService->getPackings($input);
        return view('packing.index',compact('data','packing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->packingService->getAllData();
        return view('packing.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackingRequest $packingRequest)
    {
        $input = $packingRequest->all();

        $result = $this->packingService->savePacking($input);
        if($result['success']){
            return redirect('packing')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->withInput()->with('message',$result['data'])->with('class','alert alert-danger');
        }

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
        $packing = $this->packingService->getPackingById($id);
        if(count($packing)){
            $data = $this->packingService->getAllData();
            return view('packing.edit',compact('packing','data'));
        }else{
            return redirect('packing')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-danger'); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackingRequest $packingRequest, $id)
    {
        $input = $packingRequest->all();

        $result = $this->packingService->updatePacking($input,$id);
        if($result['success']){
            return redirect('packing')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->withInput()->with('message',$result['data'])->with('class','alert alert-danger');
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

     public function getExportToExcel()
    {
        $data = $this->packingService->getPackingDataForExcel();

        Excel::create("packingMatrix-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('Packing Matrix', function($sheet) use($data) {

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
