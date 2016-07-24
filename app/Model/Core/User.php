<?php

namespace App\Model\Core;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Define relationship with single tbl.user_types record
     * @return Collection
     */
    public function userType()
    {
        return $this->hasOne('App\Model\Core\UserType', 'id', 'user_type_id');
    }

    /**
     * Define relationship with single tbl.user_details record
     * @return Collection
     */
    public function userDetail()
    {
        return $this->hasOne('App\Model\Core\userDetail', 'user_id', 'id');
    }

    /**
     * Define relationship with single tbl.cluster
     * @return Collection
     */
    public function cluster()
    {
        return $this->hasOne('App\Model\Core\Cluster', 'id', 'cluster_id');
    }
}
