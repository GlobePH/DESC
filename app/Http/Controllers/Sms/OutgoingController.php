<?php
namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sms\QueueController as Queue;

use App\Http\Requests;  
use Response;
use Curl;

use App\Model\Sms\Outbound;
use App\Model\Sms\Queue;

class OutgoingController extends Controller 
{

}