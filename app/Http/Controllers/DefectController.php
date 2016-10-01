<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\DefectService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\RejectionRequest;

class DefectController extends Controller
{
    public function __construct(DefectService $defectService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->defectService = $defectService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->defectService->getData();
        $defects = $this->defectService->getDefects($input);
        return view('defect.index',compact('defects','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->defectService->getData();
        return view('defect.create',compact('data'));
    }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RejectionRequest $rejectionRequest)
    {
        $input = Request::all();
        $result = $this->defectService->saveDefect($input);
        if($result['success']){
            return redirect('defect')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
    public function edit($id)
    {
        $data = $this->defectService->getData();
        $defect = $this->defectService->getDefectById($id);
		return view('defect.edit',compact('data','defect'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(RejectionRequest $rejectionRequest, $id)
    {
        $input = Request::all();
        $result = $this->defectService->updateDefect($input,$id);
        if($result['success']){
            return redirect('defect')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->withInput()->with('message',$result['msg'])->with('class','alert alert-danger');

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
        $this->defectService->deleteDefect($id);
        return redirect('defect')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');

    }

    public function getExportToExcel()
    {
        $data = $this->defectService->getDefectDataForExcel();

        Excel::create("defect-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('defect', function($sheet) use($data) {

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
