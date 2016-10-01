<?php namespace ksec\Services;

use ksec\Group;
use Request,Config;
use ksec\Libraries\Lib;

class GroupService {

    public function __construct(Group $group)
    {
        $this->group = $group;
	}

    public function saveGroup($input)
    {
        $input = Lib::trimInput($input);
        return $this->group->saveGroup($input);
    }

    public function getGroups($input)
    {
        $input = Lib::trimInput($input);
    	$input['paginationLimit'] = Config::get("global_vars.PAGINATION_LIMIT");
    	$groups = $this->group->getGroups($input);
    	return $groups;
    }

    public function getGroup($id)
    {
    	return $this->group->getGroupById($id);
    }

    public function updateGroup($update,$id)
    {
        $update = Lib::trimInput($update);
    	return $this->group->updateGroup($update,$id);
    }

    public function deleteGroup($id)
    {
    	return $this->group->deleteGroup($id);
    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
}