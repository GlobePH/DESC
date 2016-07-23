<?php

namespace App\Model\Sms;

use Illuminate\Database\Eloquent\Model;

class Inbound extends Model
{
    protected $table = 'inbound';
    public $timestamps = false;
    protected $fillable = [
        'cluster_id', 'reference_id', 'number', 'message', 'time_received'
    ];
}
