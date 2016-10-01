<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_users';

    public function getUserIdByRoleId($roleId)
    {
    	return $this->where('role_id',$roleId)->lists('user_id')->toArray();
    }

    public function role()
    {
       	return $this->belongsTo(Role::class,'role_id','id');
    }
}
