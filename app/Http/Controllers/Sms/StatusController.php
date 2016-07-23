<?php
namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;  
use Response;

use App\Model\Sms\OutboundStatus;


class StatusController extends Controller 
{
    public function manual(Request $request)
    {
        OutboundStatus::insert($request->all());
    }
    
    // public function status(Request $request)
    // {
        
    // }
}