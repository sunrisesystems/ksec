<?php

namespace cvmapp\Http\Controllers;

use Illuminate\Http\Request;

use cvmapp\Http\Requests;
use cvmapp\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('sentinel');
    //    $this->middleware('acl');
        $this->middleware('timeout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

   
}
