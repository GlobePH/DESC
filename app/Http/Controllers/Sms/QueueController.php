<?php
namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;  
use Response;

use App\Model\Sms\Queue;


class QueueController extends Controller 
{
    public static function queue($data = array())
    {
        Queue::insert($data);
    }
}