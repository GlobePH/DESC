<?php

namespace App\Model\Sms;

use Illuminate\Database\Eloquent\Model;

class OutboundStatus extends Model
{
    protected $table = 'outbound_status';
    publics $timestamps = false;
    protected $fillable = [
        'cluster_id', 'reference_id', 'status_code', 'status_message', 'time_notified'
    ];
}
