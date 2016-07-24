<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Auth;
use Curl;
use Config;

class PageController extends Controller
{

	/**
	 * General data of controller
	 * @var array
	 */
	public $data;

	/**
	 * Display index page
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Display dashboard page
	 * @return Response
	 */
	public function dashboard()
	{
		$this->data['title']	= Config::get('constants.title').' - Dashboard';
        $urlQuery['page']       = (isset($_GET['page']) ? $_GET['page'] : '');
		$this->data['tickets']	= Curl::to(url('api/modules/ticket').'?'.http_build_query($urlQuery))->asJson()->get();
        // $this->data['results']  = new LengthAwarePaginator($this->data['tickets']->data, $this->data['tickets']->total, 12, Paginator::resolveCurrentPage(), ['path' => url('advisory')]);
		return view('admin.dashboard')->with($this->data);
	}

	/**
	 * Insert into queue
	 * @param  Request $request
	 * @return Response
	 */
	public function closeTicket(Request $request)
	{
		$message = Curl::to(url('api/modules/ticket/'.$request->get('ticket_id')))->asJson()->get();

		$this->data['queue']	= [
			'cluster_id'	=> $message->cluster_id,
			'reference_id' 	=> $message->reference_id,
			'sms_type'		=> 2,
			'number'		=> $message->inbound->number,
			'message'		=> $request->get('message'),
			'time_prepared'	=> date('Y-m-d H:i:s'),
			'request_id'	=> 'SD1231'
		];

		$result = Curl::to(url('api/sms/queue'))->withData($this->data['queue'])->asJson(true)->post();

		$this->data['ticket'] 	= [
			'user_id'		=> $message->user_id,
			'cluster_id'	=> $message->cluster_id,
			'reference_id'	=> $message->reference_id,
			'ticket_status'	=> 1
		];
		Curl::to(url('api/modules/ticket/'.$request->get('ticket_id')))->withData($this->data['ticket'])->put();

		return ['ticket_id' => $request->get('ticket_id')];
	}

	/**
	 * Display graphs page
	 * @return Response
	 */
	public function graphs()
	{
		$this->data['title']	= Config::get('constants.title').' - Graphs';
		return view('admin.graphs')->with($this->data);
	}

}
