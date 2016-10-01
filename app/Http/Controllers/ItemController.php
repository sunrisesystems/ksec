<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\ItemService;
use ksec\Libraries\Lib;

use Request,Lang,Config,Excel;
use ksec\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function __construct(ItemService $itemService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->middleware('acl');
        $this->itemService = $itemService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $input = Request::all();
        $data = $this->itemService->getAllDataForIndex();
        $items = $this->itemService->getItems($input);
        return view('item.index',compact('data','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->itemService->getAllData();
        return view('item.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $itemRequest)
    {
        $input = $itemRequest->all();

        $this->itemService->saveItem($input);
        return redirect('item')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');

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
        $item = $this->itemService->getItemById($id);
        if(count($item)){
            $data = $this->itemService->getAllData();
            return view('item.edit',compact('item','data'));
        }else{
            return redirect('item')->with('message',Lang::get('messages.no_record'))->with('class','alert alert-danger'); 
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $itemRequest, $id)
    {
        $input = $itemRequest->all();
        $item = $this->itemService->updateItem($input,$id);
        return redirect('item')->with('message',Lang::get('messages.UPDATE_SUCC'))->with('class','alert alert-success'); 

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
        $data = $this->itemService->getItemDataForExcel();

        Excel::create("item-".date("d-m-Y"), function($excel) use($data) {

            $excel->sheet('item', function($sheet) use($data) {

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
