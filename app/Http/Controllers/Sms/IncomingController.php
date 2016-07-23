<?php
namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;  
use Response;

use App\Model\Sms\Inbound;
use App\Model\Core\Cluster;

class IncomingController extends Controller 
{
    public function inbound(Request $request)
    {
        $explodedMessage = explode(' ', $request['message']);
        Cluster::where('cluster_code', strtoupper($explodedMessage[0]))->first();
        // if()
        // {
            
        // }
    }
}