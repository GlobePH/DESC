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

    /**
     * define multiple relationship to multiple tbl.advisories records
     * @return Collection
     */
    public function advisory()
    {
    	return $this->hasMany('App\Model\Core\Advisory', 'cluster_id', 'id');
    }

    /**
     * define multiple relationship to multiple tbl.contact_numbers records
     * @return Collection
     */
    public function contactNumber()
    {
    	return $this->hasMany('App\Model\Core\ContactNumber', 'cluster_id', 'id');
    }

    /**
     * define multiple relationsup to multiple tbl.tickets records
     * @return Collection
     */
    public function ticket()
    {
    	return $this->hasMany('App\Model\Core\Ticket', 'cluster_id', 'id');
    }
}
