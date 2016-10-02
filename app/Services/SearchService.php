<?php namespace ksec\Services;

use Request,Config,DB,Validator;
use ksec\Libraries\Lib;
use Sentinel,Lang;
use ksec\Product as Product;

class SearchService {

    public function __construct(Product $product)
    {
        $this->product = $product;
	}   

    public function getKeywordSearchResult($input)
    {
        $input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
        $data = $this->product->getKeywordSearch($input);
        Lib::pr($data); exit;
        return $data;
    }
}