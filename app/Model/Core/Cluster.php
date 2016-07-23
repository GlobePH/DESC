<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'cluster_code'
    ];
}
