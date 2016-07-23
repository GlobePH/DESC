<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

	/**
	 * Define inverse relationship with tbl.users record
	 * @return Collection
	 */
	public function user()
	{
		return $this->belongsTo('App\Model\Core\User', 'user_id', 'id');
	}

}
