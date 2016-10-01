<?php

namespace ksec;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Account extends Model
{
	use SoftDeletes;
    protected $guarded = [];
    
    public function saveAccount($insert)
    {
    	return $this->create($insert);
    }

    public function getAccounts($input)
    {
        $query = $this;
        if(isset($input['name']) && !empty($input['name'])){
            $query = $query->where('name','like','%'.$input['name'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
       $query = $query->where('account_type_id',2);
        $accounts = $query->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $accounts;

    }

    public function getAccountById($id)
    {
    	return $this->find($id);
    }

    public function updateAccount($update,$id)
    {
        return $this->find($id)->update($update);
    }

    public function deleteAccount($id)
    {
    	return $this->find($id)->delete();
    }

    public function getVendorTypeAccountList()
    {
        return $this->where('account_type_id',2)->where('status','A')->lists('name','id')->toArray();
    }

    public function getCustomerTypeAccountList()
    {
        return $this->where('account_type_id',1)->where('status','A')->lists('name','id')->toArray();
    }


}
