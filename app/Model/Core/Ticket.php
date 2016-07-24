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

	/**
	 * Define relationship to tbl.inbound
	 * @return Collection
	 */
	public function inbound()
	{
		return $this->belongsTo('App\Model\Sms\Inbound', 'reference_id', 'reference_id');
	}

}
