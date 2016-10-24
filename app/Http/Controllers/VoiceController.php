<?php

namespace ksec\Http\Controllers;

use Illuminate\Http\Request;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use ksec\Services\VoiceService;
use ksec\Http\Requests\VoiceRequest;
use Lib,Lang;

class VoiceController extends Controller
{
    public function __construct(VoiceService $voiceService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->voiceService = $voiceService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $data = $this->voiceService->getAllActiveData();
        $sqHead = $this->voiceService->getVoiceSqHead($input);

        return view('voice.index',compact('data','sqHead'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->voiceService->getAllActiveData();
        return view('voice.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoiceRequest $voiceRequest)
    {
        $input = $voiceRequest->all();
      //  Lib::pr($input); exit;
        $result = $this->voiceService->saveVoiceData($input);
        if($result['success']){
            return redirect('voice')->with('message',Lang::get('messages.ADDED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
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
        $data = $this->voiceService->getAllActiveData();
        $voice = $this->voiceService->getVoiceById($id);
      //  Lib::pr($voice->toArray()); exit;
        return view('voice.edit',compact('data','voice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoiceRequest $voiceRequest, $id)
    {
        $input = $voiceRequest->all();
      //  Lib::pr($input); exit;
        $result = $this->voiceService->updateVoiceData($input,$id);
        if($result['success']){
            return redirect('voice')->with('message',Lang::get('messages.UPDATED_SUCC'))->with('class','alert alert-success');
        }else{
            return redirect()->back()->with('message',$result['data'])->with('class','alert alert-danger');
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
}
