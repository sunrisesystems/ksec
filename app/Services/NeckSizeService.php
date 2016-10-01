<?php namespace ksec\Services;

use ksec\NeckSize;
use Request,Config,Lang;
use ksec\Libraries\Lib;
use ksec\Services\DrawingService;

class NeckSizeService {

    public function __construct(NeckSize $neckSize,DrawingService $drawingService)
    {
        $this->neckSize = $neckSize;
        $this->drawingService = $drawingService;
	}

    public function saveNeckSize($input)
    {
        return $this->neckSize->saveNeckSize($input);
    }

    public function getNeckSizes($input)
    {
    	$input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
    	$types = $this->neckSize->getNeckSizes($input);
    	return $types;
    }

    public function getNeckSize($id)
    {
    	return $this->neckSize->getNeckSizeById($id);
    }

    public function updateNeckSize($update,$id)
    {
    	return $this->neckSize->updateNeckSize($update,$id);
    }

    public function deleteNeckSize($id)
    {
        $result['success'] = 0;
        /* dependancy check on drawing*/
        
        $neckSize = $this->drawingService->checkDependancyForNeckSize($id);
        if($neckSize){
            $result['data'] = Lang::get('messages.DRAWING_NECKSIZE_DEPENDANCY');
            return $result;
        }
    	$this->neckSize->deleteNeckSize($id);
        $result['success'] = 1;
        return $result; 
    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
}