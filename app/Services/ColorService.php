<?php namespace ksec\Services;

use ksec\Color;
use ksec\Product;
use Request,Config,Lang;
use ksec\Libraries\Lib;

class ColorService {

    public function __construct(Color $color, Product $product)
    {
        $this->color = $color;
        $this->product = $product;
	}

    public function saveColor($input)
    {
        return $this->color->saveColor($input);
    }

    public function getColors($input)
    {
        $input = Lib::trimInput($input);
    	$input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
    	$colors = $this->color->getColors($input);
    	return $colors;
    }

    public function getColor($id)
    {
    	return $this->color->getColorById($id);
    }

    public function updateColor($update,$id)
    {
    	return $this->color->updateColor($update,$id);
    }

    public function deleteColor($id)
    {
        $result['success'] = 0;
        /* check dependancy for product */
        $color = $this->product->checkDependancyForColor($id);
        if($color){
            $result['data'] = Lang::get('messages.PRODUCT_COLOR_DEPENDANCY');
            return $result;
        }
        $this->color->deleteColor($id);
        $result['success'] = 1;
        return $result; 
    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
}