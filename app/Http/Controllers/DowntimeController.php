<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\DowntimeService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\DowntimeSubreasonRequest;

class DowntimeController extends Controller
{
    public function __construct(DowntimeService $downtimeService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->downtimeService = $downtimeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->downtimeService->getData();
        $subreasons = $this->downtimeService->getSubreasons($input);
        return view('downtime.index',compact('subreasons','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->downtimeService->getData();
        return view('downtime.create',compact('data'));
    }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(DowntimeSubreasonRequest $subreasonRequest)
    {
         $input = Request::all();

        $this->downtimeService->saveSubreason($input);
        return redirect('downtime')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
    
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
        $subreason = $this->downtimeService->getSubreasonById($id);
        $data = $this->downtimeService->getData();
		return view('downtime.edit',compact('data','subreason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(DowntimeSubreasonRequest $subreasonRequest, $id)
    {
        $input = Request::all();
        $shape = $this->downtimeService->updateSubreason($input,$id);
        return redirect('downtime')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $subreason = $this->downtimeService->deleteSubreason($id);
        return redirect('downtime')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success'); 

    }

    public function getExportToExcel()
    {
        $data = $this->downtimeService->getDowntimeDataForExcel();

        Excel::create("downtime-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('downtime', function($sheet) use($data) {

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
