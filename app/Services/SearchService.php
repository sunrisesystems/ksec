<?php namespace cvmapp\Services;

use Request,Config,DB,Validator;
use cvmapp\Libraries\Lib;
use Sentinel,Lang;
use cvmapp\Product as Product;

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