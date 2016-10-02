<?php

namespace cvmapp;

use Illuminate\Database\Eloquent\Model;

class AclModule extends Model
{
    protected $guarded = [];

    public static function getACL($controller,$action)
    {
    	return AclModule::where('controller',$controller)->where('action',$action)->select(['task','module'])->first();
    }

    public static function getACLForController($controller)
    {
    	return AclModule::where('controller',$controller)->select(['module'])->first();
    }
}
