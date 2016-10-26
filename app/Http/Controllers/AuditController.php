<?php

namespace ksec\Http\Controllers;

use Illuminate\Http\Request;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\AuditService;
use Lib;

class AuditController extends Controller
{
    public function __construct(AuditService $auditService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
        $this->auditService = $auditService;
    }

    public function getIndex()
    {
        $data = $this->auditService->getIndexData();
     //   Lib::pr($data); exit;
        return view("audit.index",compact('data'));
    }

    public function postIndex(Request $request)
    {
        $input = $request->all();
        Lib::pr($$input);
    }
}
