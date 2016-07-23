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

    /**
     * Inverse relation to tbl.clusters
     * @return Collection
     */
    public function cluster()
    {
    	return $this->belongsTo('App\Model\Core\Cluster', 'cluster_id', 'id');
    }

    /**
     * Inverse relation to tbl.users records
     * @return Colleciton
     */
    public function user()
    {
    	return $this->belongsTo('App\Model\Core\User', 'user_id', 'id');
    }
}
