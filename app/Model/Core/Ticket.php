<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

	/**
	 * Define inverse relationship to tbl.clusters
	 * @return Collection
	 */
	public function cluster()
	{
		return $this->belongsTo('App\Model\Core\Cluster', 'cluster_id', 'id');
	}

}
