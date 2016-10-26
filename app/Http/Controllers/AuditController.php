<?php

namespace ksec\Http\Controllers;

use Illuminate\Http\Request;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;

use ksec\Services\AuditService;

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
        return view("audit.index",compact('data'));
    }
}
