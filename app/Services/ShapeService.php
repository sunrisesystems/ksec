<?php namespace ksec\Services;

use ksec\Shape;
use ksec\Drawing as Drawing;
use Request,Config,Lang;
use ksec\Libraries\Lib;

class ShapeService {

    public function __construct(Shape $shape,
                                Drawing $drawing)
    {
        $this->shape = $shape;
        $this->drawing = $drawing;
	}

    public function saveShape($input)
    {
        $input = Lib::trimInput($input);
        return $this->shape->saveShape($input);
    }

    public function getShapes($input)
    {
        $input = Lib::trimInput($input);
    	$input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
    	$shapes = $this->shape->getShapes($input);
    	return $shapes;
    }

    public function getShapeById($id)
    {
    	return $this->shape->getShapeById($id);
    }

    public function updateShape($update,$id)
    {
        $update = Lib::trimInput($update);
    	return $this->shape->updateShape($update,$id);
    }

    public function deleteShape($id)
    {
        $result['success'] = 0;
        /* dependancy check on drawings */
        $dependancy = $this->drawing->getByShapeId($id);
        if($dependancy){
            $result['data'] = Lang::get('messages.SHAPE_DEPENDANCY');
        }else{
            $this->shape->deleteShape($id);
            $result['success'] = 1;
        }
    	return $result; 
    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
}