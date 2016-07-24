<?php
namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;  
use Response;

use App\Model\Sms\OutboundStatus;
use App\Model\Sms\Outbound;


class StatusController extends Controller 
{
    public function manual(Request $request)
    {
        OutboundStatus::insert($request->all());
    }
    
    public function status(Request $request)
    {
        file_put_contents(base_path('logs/sms/notify/').'notify_'.date('Ymd').'.log', '['.date('Y-m-d H:i:s').']'. json_encode($request->all()) . "\n" , FILE_APPEND);
        $outboundDetails = Outbound::where('reference_id', $request['message_id'])->first();
        $data = [
            'reference_id' => $request['message_id'],
            'status_code' => '200',
            'status_message' => $request['status'],
            'cluster_id' => $outboundDetails->cluster_id,
            'status_description' => ''
        ];
        OutboundStatus::insert($data);
    }
}