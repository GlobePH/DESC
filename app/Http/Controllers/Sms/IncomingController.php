<?php
namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sms\QueueController as Queue;

use App\Http\Requests;  
use Response;
use Redis;
use Curl;

use App\Model\Sms\Inbound;

use App\Model\Core\Cluster;
use App\Model\Core\CannedResponse;
use App\Model\Core\Ticket;

class IncomingController extends Controller 
{
    public function inbound(Request $request)
    {
        file_put_contents(base_path('logs/sms/inbound/').'inbound_'.date('Ymd').'.log', '['.date('Y-m-d H:i:s').']'. json_encode($request->all()) . "\n" , FILE_APPEND);
        $explodedMessage = explode(' ', $request['message']);
        $referenceID = strtoupper("DESC". substr(md5(uniqid(rand(), true)), 10, 17)) . time();
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
                'reference_id' => $referenceID,
                'number'=> $request['mobile_number'],
                'sms_type' => 1,
                'message' => $responseMessage,
                'time_prepared' => date('Y-m-d H:i:s'),
                'request_id' => $request['request_id']
            ];
        } else {
            $infoResponse = CannedResponse::where('info_code', strtoupper($explodedMessage[1]))->where('cluster_id', $validateCluster->id)->where('response_type', 3)->first();
            if($infoResponse){
                $validMessage = CannedResponse::where('response_type', 1)->first();
                $responseMessage = str_replace('{#cluster}', $validateCluster->name, $validMessage['message']);
                $dataQueue = [
                    'cluster_id' => $validateCluster->id,
                    'reference_id' => $referenceID,
                    'number'=> $request['mobile_number'],
                    'sms_type' => 1,
                    'message' => $infoResponse->message,
                    'time_prepared' => date('Y-m-d H:i:s'),
                    'request_id' => $request['request_id']
                ];
            } else { 
                $validMessage = CannedResponse::where('response_type', 1)->first();
                $responseMessage = str_replace('{#cluster}', $validateCluster->name, $validMessage['message']);
                $dataQueue = [
                    'cluster_id' => $validateCluster->id,
                    'reference_id' => $referenceID,
                    'number'=> $request['mobile_number'],
                    'sms_type' => 1,
                    'message' => $responseMessage,
                    'time_prepared' => date('Y-m-d H:i:s'),
                    'request_id' => $request['request_id']
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
                Curl::to(url("api/modules/ticket"))
                ->withData(["reference_id" => $data['reference_id'], "user_id" => 1, "cluster_id" => $validateCluster->id, "ticket_status" => 0])
                ->post();
            
                $redis = Redis::connection();
                $redis->publish('notification.' . $validateCluster->id, $referenceID);                            
            }
        }
        
        Queue::queue($dataQueue);
    }
    
    public function find($id)
    {
        return Inbound::where('reference_id', $id)->first();
    }
}