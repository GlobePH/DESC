<?php
namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sms\QueueController as Queue;

use App\Http\Requests;  
use Response;
use Redis;


use App\Model\Sms\Inbound;

use App\Model\Core\Cluster;
use App\Model\Core\CannedResponse;
use App\Model\Core\Ticket;

class IncomingController extends Controller 
{
    public function inbound(Request $request)
    {
        $explodedMessage = explode(' ', $request['message']);
        $validateCluster = Cluster::where('cluster_code', strtoupper($explodedMessage[0]))->first();
        if(empty($validateCluster))
        {
            $invalidMessage = CannedResponse::where('response_type', 2)->first();
            $clusters = Cluster::get()->toArray();
            $substitute = "";
            foreach($clusters as $cluster_key => $cluster_value){
                $substitute .= $cluster_value['cluster_code']." for ".$cluster_value['name']."\n";
            }            
            $responseMessage = str_replace('{#cluster}', "\n".$substitute, $invalidMessage['message']);
            $dataQueue = [
                'cluster_id' => 0,
                'reference_id' => strtoupper("DESC" . substr(md5(uniqid(rand(), true)), 10, 17)) . time(),
                'number'=> $request['mobile_number'],
                'sms_type' => 1,
                'message' => $responseMessage,
                'delivery' => 0,
                'time_prepared' => date('Y-m-d H:i:s')
            ];
        } else {
            $referenceID = strtoupper("DESC". substr(md5(uniqid(rand(), true)), 10, 17)) . time();
            $validMessage = CannedResponse::where('response_type', 1)->first();
            $responseMessage = str_replace('{#cluster}', $validateCluster->name, $validMessage['message']);
            $dataQueue = [
                'cluster_id' => 0,
                'reference_id' => $referenceID,
                'number'=> $request['mobile_number'],
                'sms_type' => 1,
                'message' => $responseMessage,
                'delivery' => 0,
                'time_prepared' => date('Y-m-d H:i:s')
            ];
            unset($explodedMessage[0]);
            $inboundMessage = implode(" ", $explodedMessage);
            
            $data = [
                'cluster_id' => $validateCluster->id,
                'reference_id' => $referenceID,
                'number' => $request['mobile_number'],
                'message' => $inboundMessage,
                'time_received' => date('Y-m-d H:i:s', $request['timestamp']),
                'request_id' => $request['request_id']
            ];    
            
            Inbound::insert($data);
            
        $redis = Redis::connection();
        $redis->publish('notification.' . $validateCluster->id, $referenceID);            
        }
        
        Queue::queue($dataQueue);
    }
}