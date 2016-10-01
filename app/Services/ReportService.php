<?php namespace ksec\Services;

use Request,Config,Lang,Sentinel;
use ksec\Libraries\Lib;
use ksec\Shift;
use ksec\DailyEntryMachine;
use ksec\Product;
use ksec\Machine;
use ksec\Unit;

class ReportService {

    public function __construct(Shift $shift,DailyEntryMachine $dailyEntryMachine,Product $product,Machine $machine,Unit $unit)
    {
        $this->shift = $shift;
        $this->user = Sentinel::getUser();
        $this->dailyEntryMachine = $dailyEntryMachine;
        $this->product = $product;
        $this->machine = $machine;
        $this->unit = $unit;
	}

    public function getShifts()
    {
        $user = $this->user;
        return $this->shift->getShiftListByUnit($user->unit_id);
    }

    public function getShiftName($shiftIds)
    {
        return $this->shift->getShiftName($shiftIds);
    }

    public function getDailyProductionReport($input)
    {
        if(!empty($input['fromDate'])){
            $input['fromDate'] = Lib::convertDateFormat("d-m-Y",$input['fromDate'],"Y-m-d");
        }
        if(!empty($input['toDate'])){
            $input['toDate'] = Lib::convertDateFormat("d-m-Y",$input['toDate'],"Y-m-d");
        }

        $result['data'] = $this->dailyEntryMachine->getDailyProductionReport($input);
        $result['downtime'] = $this->dailyEntryMachine->getTotalDowntime($input);
        return $result;
    }

    public function getManagementReport($input)
    {
        if(!empty($input['date'])){
            $input['date'] = Lib::convertDateFormat("d-m-Y",$input['date'],"Y-m-d");
        }
        $result['productionDetails'] = $this->dailyEntryMachine->getManagementReport($input);
        $downtime['production'] = $this->dailyEntryMachine->getProductionDowntime($input);
        $downtime['moldChangeOver'] = $this->dailyEntryMachine->getMoldChangeOverDowntime($input);
        $downtime['powerBreakDown'] = $this->dailyEntryMachine->getPowerBreakDownDowntime($input);
        $downtime['others'] = $this->dailyEntryMachine->getOtherDowntime($input);
        $result['downtimeDetails'] = $downtime;

        // get first date of provided month
        $input['fromDate'] = Lib::getFirstDateOfTheMonth($input['date']);
        $result['productionDetailMTD'] = $this->dailyEntryMachine->getDailyProductionMtd($input);
        return $result;
    }

    public function getMachineList()
    {
        $user = $this->user;
        return $this->machine->getMachineByUnitId($user->unit_id);
    }

    public function getProductList()
    {
        return $this->product->getProductList();
        
    }

    public function getUnitName()
    {
        $user = $this->user;
        $unitName = $this->unit->getUnitName($user->unit_id);
        return $unitName;
    }

}