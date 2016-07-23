<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Advisory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cluster_id', 'name', 'summary', 'content', 'status'
    ];
}
