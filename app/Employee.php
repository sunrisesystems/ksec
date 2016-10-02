<?php

/**
 * Part of the Sentinel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Sentinel
 * @version    2.0.7
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2015, Cartalyst LLC
 * @link       http://cartalyst.com
 */

namespace ksec;

use Cartalyst\Sentinel\Permissions\PermissibleInterface;
use Cartalyst\Sentinel\Permissions\PermissibleTrait;
use Cartalyst\Sentinel\Persistences\PersistableInterface;
use Cartalyst\Sentinel\Roles\RoleableInterface;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\UserInterface;
use Config;

class Employee extends Model implements RoleableInterface, PermissibleInterface, PersistableInterface, UserInterface
{
    use PermissibleTrait;

    /**
     * {@inheritDoc}
     */
    protected $table = 'employees';
    protected $hidden = ['password', 'remember_token'];

    /**
     * {@inheritDoc}
     */
    protected $guarded = [];

    /**
     * {@inheritDoc}
     */
    protected $persistableKey = 'user_id';

    /**
     * {@inheritDoc}
     */
    protected $persistableRelationship = 'persistences';

    /**
     * Array of login column names.
     *
     * @var array
     */
    protected $loginNames = ['system_id','status','allow_login'];

    /**
     * The Eloquent roles model name.
     *
     * @var string
     */
    protected static $rolesModel = 'Cartalyst\Sentinel\Roles\EloquentRole';

    /**
     * The Eloquent persistences model name.
     *
     * @var string
     */
    protected static $persistencesModel = 'Cartalyst\Sentinel\Persistences\EloquentPersistence';

    /**
     * The Eloquent activations model name.
     *
     * @var string
     */
    protected static $activationsModel = 'Cartalyst\Sentinel\Activations\EloquentActivation';

    /**
     * The Eloquent reminders model name.
     *
     * @var string
     */
    protected static $remindersModel = 'Cartalyst\Sentinel\Reminders\EloquentReminder';

    /**
     * The Eloquent throttling model name.
     *
     * @var string
     */
    protected static $throttlingModel = 'Cartalyst\Sentinel\Throttling\EloquentThrottle';

    /**
     * Returns an array of login column names.
     *
     * @return array
     */
    public function getLoginNames()
    {
        return $this->loginNames;
    }

    /**
     * Returns the roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(static::$rolesModel, 'role_users', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * Returns the persistences relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function persistences()
    {
        return $this->hasMany(static::$persistencesModel, 'user_id');
    }

    /**
     * Returns the activations relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activations()
    {
        return $this->hasMany(static::$activationsModel, 'user_id');
    }

    /**
     * Returns the reminders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reminders()
    {
        return $this->hasMany(static::$remindersModel, 'user_id');
    }

    /**
     * Returns the throttle relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function throttle()
    {
        return $this->hasMany(static::$throttlingModel, 'user_id');
    }

    /**
     * Get mutator for the "permissions" attribute.
     *
     * @param  mixed  $permissions
     * @return array
     */
    public function getPermissionsAttribute($permissions)
    {
        return $permissions ? json_decode($permissions, true) : [];
    }

    /**
     * Set mutator for the "permissions" attribute.
     *
     * @param  mixed  $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = $permissions ? json_encode($permissions) : '';
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritDoc}
     */
    public function inRole($role)
    {
        $role = array_first($this->roles, function ($index, $instance) use ($role) {
            if ($role instanceof RoleInterface) {
                return ($instance->getRoleId() === $role->getRoleId());
            }

            if ($instance->getRoleId() == $role || $instance->getRoleSlug() == $role) {
                return true;
            }

            return false;
        });

        return $role !== null;
    }

    /**
     * {@inheritDoc}
     */
    public function generatePersistenceCode()
    {
        return str_random(32);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId()
    {
        return $this->getKey();
    }

    /**
     * {@inheritDoc}
     */
    public function getPersistableId()
    {
        return $this->getKey();
    }

    /**
     * {@inheritDoc}
     */
    public function getPersistableKey()
    {
        return $this->persistableKey;
    }

    /**
     * {@inheritDoc}
     */
    public function setPersistableKey($key)
    {
        $this->persistableKey = $key;
    }

    /**
     * {@inheritDoc}
     */
    public function setPersistableRelationship($persistableRelationship)
    {
        $this->persistableRelationship = $persistableRelationship;
    }

    /**
     * {@inheritDoc}
     */
    public function getPersistableRelationship()
    {
        return $this->persistableRelationship;
    }

    /**
     * {@inheritDoc}
     */
    public function getUserLogin()
    {
        return $this->getAttribute($this->getUserLoginName());
    }

    /**
     * {@inheritDoc}
     */
    public function getUserLoginName()
    {
        return reset($this->loginNames);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserPassword()
    {
        return $this->password;
    }

    /**
     * Returns the roles model.
     *
     * @return string
     */
    public static function getRolesModel()
    {
        return static::$rolesModel;
    }

    /**
     * Sets the roles model.
     *
     * @param  string  $rolesModel
     * @return void
     */
    public static function setRolesModel($rolesModel)
    {
        static::$rolesModel = $rolesModel;
    }

    /**
     * Returns the persistences model.
     *
     * @return string
     */
    public static function getPersistencesModel()
    {
        return static::$persistencesModel;
    }

    /**
     * Sets the persistences model.
     *
     * @param  string  $persistencesModel
     * @return void
     */
    public static function setPersistencesModel($persistencesModel)
    {
        static::$persistencesModel = $persistencesModel;
    }

    /**
     * Returns the activations model.
     *
     * @return string
     */
    public static function getActivationsModel()
    {
        return static::$activationsModel;
    }

    /**
     * Sets the activations model.
     *
     * @param  string  $activationsModel
     * @return void
     */
    public static function setActivationsModel($activationsModel)
    {
        static::$activationsModel = $activationsModel;
    }

    /**
     * Returns the reminders model.
     *
     * @return string
     */
    public static function getRemindersModel()
    {
        return static::$remindersModel;
    }

    /**
     * Sets the reminders model.
     *
     * @param  string  $remindersModel
     * @return void
     */
    public static function setRemindersModel($remindersModel)
    {
        static::$remindersModel = $remindersModel;
    }

    /**
     * Returns the throttling model.
     *
     * @return string
     */
    public static function getThrottlingModel()
    {
        return static::$throttlingModel;
    }

    /**
     * Sets the throttling model.
     *
     * @param  string  $throttlingModel
     * @return void
     */
    public static function setThrottlingModel($throttlingModel)
    {
        static::$throttlingModel = $throttlingModel;
    }

    /**
     * {@inheritDoc}
     */
    public function delete()
    {
        if ($this->exists) {
            $this->activations()->delete();
            $this->persistences()->delete();
            $this->reminders()->delete();
            $this->roles()->detach();
            $this->throttle()->delete();
        }

        parent::delete();
    }

    /**
     * Dynamically pass missing methods to the user.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $methods = ['hasAccess', 'hasAnyAccess'];

        if (in_array($method, $methods)) {
            $permissions = $this->getPermissionsInstance();

            return call_user_func_array([$permissions, $method], $parameters);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Creates a permissions object.
     *
     * @return \Cartalyst\Sentinel\Permissions\PermissionsInterface
     */
    protected function createPermissions()
    {
        $userPermissions = $this->permissions;

        $rolePermissions = [];

        foreach ($this->roles as $role) {
            $rolePermissions[] = $role->permissions;
        }

        return new static::$permissionsClass($userPermissions, $rolePermissions);
    }

    public function getEmployees($input)
    {
        $query = $this;
        if(isset($input['status']) && !empty($input['status'])){
            $query = $query->where('status',$input['status']);
        }
        if(isset($input['userId']) && !empty($input['userId'])){
            $query = $query->whereIn('id',$input['userId']);
        }
        if(isset($input['name']) && !empty($input['name'])){
            $query = $query->where('emp_name','like','%'.$input['name'].'%');
        }
        if(isset($input['allowLogin']) && !empty($input['allowLogin'])){
            $query = $query->where('allow_login',$input['allowLogin']);
        }
        $users = $query->with('userRole')->orderBy('id','desc')->paginate($input['paginationLimit']);
        return $users;
    }

    public function userRole()
    {
       return $this->belongsTo(UserRole::class,'id','user_id');
    }

    public function findById($id)
    {
        return $this->with('userRole.role')->where('id',$id)->first();
    }

    public function updateUser($update,$id)
    {
        return $this->find($id)->update($update);
    }

    public function getActiveManagerEmplyeeList()
    {
        return $this->where("emp_type_id",Config::get("global_vars.HARD_CODED_ID.managerId"))->where('status','A')->lists('emp_name','id')->toArray();
    }

    public function getActiveTeamLeadEmplyeeList()
    {
        return $this->where("emp_type_id",Config::get("global_vars.HARD_CODED_ID.teamLead"))->where('status','A')->lists('emp_name','id')->toArray()    ;
        
    }

    public function getActiveEmployeeEmailList()
    {
        return $this->where('status','A')->lists('email','id')->toArray();
    }
}
