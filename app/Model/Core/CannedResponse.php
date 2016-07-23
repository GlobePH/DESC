<?php

namespace App\Model\Core;

use Illuminate\Database\Eloquent\Model;

class CannedResponse extends Model
{
    protected $table = 'canned_response';
    protected $fillable = [
        'response_id', 'message'
    ];
}
