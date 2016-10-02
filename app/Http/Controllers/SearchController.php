<?php

namespace ksec\Http\Controllers;

use ksec\Http\Requests;
use ksec\Http\Controllers\Controller;
use Request,Lib;
use ksec\Services\SearchService;

class SearchController extends Controller
{
	public function __construct(SearchService $searchService)
    {
        $this->middleware('sentinel');
        $this->middleware('timeout');
      //  $this->middleware('acl');
        $this->searchService = $searchService;
    }

    public function getIndex()
    {
        $input = Request::all();
        /*if(!empty($input)){
        	$searchResult = $this->searchService->getKeywordSearchResult($input);
        }else{
        	$searchResult = [];
        }*/
    	return view('search.index');
    }
}
