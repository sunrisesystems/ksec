<?php namespace ksec\Services;

use ksec\DowntimeSubreason as DowntimeSubreason;
use ksec\DowntimeReason as DowntimeReason;
use Request,Config;
use ksec\Libraries\Lib;

class DowntimeService {

    public function __construct(DowntimeSubreason $downtimeSubreason,
                                DowntimeReason $downtimeReason)
    {
        $this->downtimeReason = $downtimeReason;
        $this->downtimeSubreason = $downtimeSubreason;
	}


    public function getData(){
        $data['downtimeReason'] = Lib::addSelect($this->downtimeReason->getDowntimeReasonList());
        $data['status'] = Lib::addSelect(Config::get('global_vars.STATUS_ARR'));
        return $data;
    }

    public function saveSubreason($insert)
    {
        return $this->downtimeSubreason->saveSubreason($insert);
    }

    public function getSubreasons($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $shapes = $this->downtimeSubreason->getSubreasons($input);
        return $shapes;
    }

    public function getSubreasonById($id)
    {
        return $this->downtimeSubreason->getSubreasonById($id);
    }

    public function updateSubreason($update,$id)
    {
        return $this->downtimeSubreason->updateSubreason($update,$id);
    }

    public function deleteSubreason($id)
    {
        return $this->downtimeSubreason->deleteSubreason($id);
    }

    public function getDowntimeDataForExcel()
    {
        $data = [];
        $downtime = $this->downtimeSubreason->getAllDowntimeSubReasons();
        if(!empty($downtime)){
            $supportData = $this->getData();
            $keys = ['Id', 'Downtime Reason','Downtime Subreason','Status'];
            array_push($data, $keys);
            
            foreach ($downtime as $key => $value) {
                unset($value['created_at']);
                unset($value['updated_at']);
                unset($value['deleted_at']);
                $value['downtime_reason_id'] = @$supportData['downtimeReason'][$value['downtime_reason_id']];
                $value['status'] = $supportData['status'][$value['status']];
                array_push($data, $value);
            }
        }
        return $data;
    }
}