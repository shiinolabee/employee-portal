<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function employee()
    {
        return $this->hasOne('App\Models\Employee','user_id');
    }

    public function empStation()
    {
        return $this->hasOne('App\Models\EmpStation','emp_user_id');
    }

    public function roleUsers()
    {
        return $this->hasMany('App\Models\RoleUser');
    }

    public function vwUserEmployee()
    {
        return $this->hasOne('App\Models\VWUserEmployee');
    }

    public function getFloorPlanAttribute()
    {
        return $this->empStation->fpStation;
    }

    public function getListFloorPlanAttribute()
    {
        return $this->empStation->fpStation->ListFloorPlan;
    }
}
