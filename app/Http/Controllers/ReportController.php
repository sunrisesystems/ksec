<?php

namespace ksec\Http\Controllers;

//use Illuminate\Http\Request;

//use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use PDF,Request,Session;
use ksec\Services\ReportService;
use ksec\Libraries\Lib;

class ReportController extends Controller
{

    public function __construct(ReportService $reportService)
    {
        $this->middleware('timeout');
        $this->middleware('sentinel');
        $this->middleware('acl');
        $this->reportService  = $reportService;
    }

    public function getProductionReport()
    {
        $shifts = $this->reportService->getShifts();
        return view('reports.dailyProductionReport',compact('shifts'));
    }
	
	public function getManagementReport()
    {
        $shifts = $this->reportService->getShifts();
        return view('reports.dailyManagementReport',compact('shifts'));
    }

    public function getManagementReportPdf()
    {
        if(Session::has('managementReportInput')){
            $input = Session::get('managementReportInput');
            // get shift details
            $result = $this->reportService->getManagementReport($input);
            $input['shiftName'] = $this->reportService->getShiftName($input['shift']);
            $input['unitName'] = $this->reportService->getUnitName();    
            $fileName = 'managementReport_'.$input['date']."_".$input["unitName"].".pdf";
            
            $pdf = PDF::loadView('reports.managementReportPdf',compact('result','input'));
            return $pdf->download($fileName);
        }
        // $pdf = PDF::loadView('reports.managementReportPdf');
      //  return $pdf->download("managementReport.pdf");
      // return view('reports.managementReportPdf');
    }

    public function postManagementReport()
    {
        $input = Request::all();
        Session::put('managementReportInput',$input);
        $result = $this->reportService->getManagementReport($input);
        $input['shiftName'] = $this->reportService->getShiftName($input['shift']);
        $input['unitName'] = $this->reportService->getUnitName();    
        return view('reports.managementReportTable',compact('result','input'));
    }

    public function getDailyProductionPdf()
    {
        try {
            if(Session::has('dailyProductionReportInput')){
                $input = Session::get('dailyProductionReportInput');

                // get shift details
                $output = $this->reportService->getDailyProductionReport($input);
                $result = $output['data'];
                $totalDowntime = $output['downtime'];
                $input['shiftName'] = $this->reportService->getShiftName($input['shift']);
                $fileName = 'dailyProductionReport_'.$input['fromDate']."_to_".$input['toDate'].".pdf";
                if(!empty($result)){
                    $machineList = $this->reportService->getMachineList();
                    $productList = $this->reportService->getProductList();
                }else{
                    $machineList = [];
                    $productList = [];
                }
              //  return view('reports.dailyProductionReportPdf',compact('result','machineList','productList','input','totalDowntime'));
                //Lib::pr([$machineList,$productList,$input,$totalDowntime]); exit;
                $pdf = PDF::loadView('reports.dailyProductionReportPdf',compact('result','machineList','productList','input','totalDowntime'));
                return $pdf->download($fileName);
            }    
        } catch (Exception $e) {
            Lib::pr($e->getMessage()); exit;
        }
        
    }

    public function postDailyProductionReport()
    {
        $input = Request::all();
        Session::put('dailyProductionReportInput',$input);
        $output = $this->reportService->getDailyProductionReport($input);
        $result = $output['data'];
        $totalDowntime = $output['downtime'];
        if(!empty($output['data'])){
            $machineList = $this->reportService->getMachineList();
            $productList = $this->reportService->getProductList();
        }else{
            $machineList = [];
            $productList = [];
        }

        return view('reports.dailyProductionTable',compact('result','machineList','productList','totalDowntime'));
    }
}
