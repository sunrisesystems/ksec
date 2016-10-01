<?php

namespace ksec\Http\Controllers;

use Request,Lang,Excel;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\DrawingService;
use ksec\Http\Requests\DrawingRequest;
use ksec\Libraries\Lib;

class DrawingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct(DrawingService $drawingService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        
        $this->drawingService  = $drawingService;
    }


    public function index()
    {
        $input = Request::all();
        $data = $this->drawingService->getAllDataForIndex();
        $drawings = $this->drawingService->getDrawings($input);
        return view('drawing.index',compact('drawings','data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = $this->drawingService->getAllData();
        return view('drawing.create',compact('data'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(DrawingRequest $drawingRequest)
    {
        $input = Request::all();
        $imageData = [];
        if(Request::hasFile('drawing_file')){
            $imageData['drawingFile'] = Request::file('drawing_file');   
        }else{
            $imageData['drawingFile'] = '';
        }

        if(Request::hasFile('attachments')){
            $imageData['attachments'] = Request::file('attachments');   
        }else{
            $imageData['attachments'] = '';
        }
        $result = $this->drawingService->saveDrawing($input,$imageData);
        if($result)
            return redirect('drawings')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->drawingService->getAllData();
        $drawing = $this->drawingService->getDrawingById($id);
        $drawingAttachments = $this->drawingService->getDrawingAttachmentsByDrawingId($id);
       // Lib::pr($drawingAttachments->toArray()); exit;
        return view('drawing.edit',compact('data','drawing','drawingAttachments')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(DrawingRequest $drawingRequest, $id)
    {
        $input = Request::all();
        $imageData = [];
        if(Request::hasFile('drawing_file')){
            $imageData['drawingFile'] = Request::file('drawing_file');   
        }else{
            $imageData['drawingFile'] = '';
        }

        if(Request::hasFile('attachments')){
            $imageData['attachments'] = Request::file('attachments');   
        }else{
            $imageData['attachments'] = '';
        }
        $result = $this->drawingService->updateDrawing($input,$imageData,$id);
        if($result)
            return redirect('drawings')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success');
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
        $drawing = $this->drawingService->deleteDrawing($id);
        if($drawing['success'])
            return redirect('drawings')->with('message',Lang::get('messages.DELETE_SUCC'))->with('class','alert alert-success'); 
        else
            return redirect()->back()->with('message',$drawing['msg'])->with('class','alert alert-danger'); 

    }

    public function getMoldTradeName()
    {
        $input = Request::all();
        $data = $this->drawingService->getMoldTradeName($input);
        return response()->json($data);
        
    }

    public function getExportToExcel()
    {
        $data = $this->drawingService->getDataForExcel();

        Excel::create("drawings-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('drawings', function($sheet) use($data) {

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
