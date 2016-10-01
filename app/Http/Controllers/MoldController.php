<?php

namespace ksec\Http\Controllers;

use Request,Lang,Config,Excel,Sentinel;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\MoldService;
use ksec\Http\Requests\MoldRequest;
use ksec\Libraries\Lib;


class MoldController extends Controller
{

    public function __construct(MoldService $moldService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->moldService  = $moldService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $molds = $this->moldService->getMolds($input);
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return view('mold.index',compact('molds','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->moldService->getAllData();
        return view('mold.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(MoldRequest $moldRequest)
    {
        $input = Request::all();
        $result = $this->moldService->saveMold($input);
        if($result['success']){
            return redirect('mold')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        $mold = $this->moldService->getMold($id);
        if(count($mold)){
            $unitId = Sentinel::getUser()->unit_id;
            if($unitId == $mold->unit_id){
                $data = $this->moldService->getAllData();
                return view('mold.edit',compact('mold','data'));
            }else{
                return redirect('mold')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-danger');
            }
            
        }else{
            return redirect('mold')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-danger');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(MoldRequest $moldRequest, $id)
    {
        $input = Request::all();
        $result = $this->moldService->updateMold($input,$id);
         if($result['success']){
            return redirect('mold')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->withInput()->with('message',$result['msg'])->with('class','alert alert-danger');

        }
        //return redirect('mold')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->moldService->deleteMold($id);
        return redirect('mold')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success');

    }

    public function getExportToExcel()
    {
        $data = $this->moldService->getDataForExcel();

        Excel::create("mold-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('molds', function($sheet) use($data) {

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
