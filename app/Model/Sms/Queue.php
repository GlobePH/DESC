<?php

namespace App\Model\Sms;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'queue';
    public $timestamps = false;
    protected $fillable = [
        'cluster_id', 'reference_id', 'sms_type', 'number', 'message', 'time_prepared', 'request_id'
    ];
}
