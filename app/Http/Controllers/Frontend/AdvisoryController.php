<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Http\Requests;

use Auth;
use Curl;
use Config;
use Session;

use App\Model\Core\ContactNumber;
use App\Http\Controllers\Sms\QueueController as Queue;

class AdvisoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = Config::get('constants.title').' - Public Advisories';
        $this->data['clusters']     = Curl::to(url('api/modules/cluster'))->asJson()->get();

        $urlQuery['page']       = (isset($_GET['page']) ? $_GET['page'] : '');
        $urlQuery['cluster']    = (isset($_GET['cluster']) ? $_GET['cluster'] : $this->data['clusters']->data[0]->id);
        $urlQuery['q']          = (isset($_GET['q']) ? $_GET['q'] : '');

        $this->data['advisories']   = Curl::to(url('api/modules/advisory').'?'.http_build_query($urlQuery))->asJson()->get();
        $this->data['message']     = '';
        if (Session::has('message')) {
            $this->data['message']  = Session::get('message');
        }

        $this->data['results']  = new LengthAwarePaginator($this->data['advisories']->data, $this->data['advisories']->total, 10, Paginator::resolveCurrentPage(), ['path' => url('advisory')]);

        return view('advisory.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title']        = Config::get('constants.title').' - Create Advisory';
        $this->data['clusters']     = Curl::to(url('api/modules/cluster'))->asJson()->get();
        return view('advisory.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->data['advisory']     = [
            'user_id'   => Auth::user()->id,
            'name'      => $request->get('name'),
            'cluster_id' => $request->get('cluster'),
            'summary'   => $request->get('summary'),
            'content'   => $request->get('content'),
            'status'    => 1
        ];
        $response = Curl::to(url('api/modules/advisory'))->withData($this->data['advisory'])->asJson(true)->post();
        $numbers = ContactNumber::where('cluster_id', $request->get('cluster'))->get();
        foreach($numbers as $number){
            $dataQueue = [
                'cluster_id' => $request->get('cluster'),
                'reference_id' => strtoupper("DESC". substr(md5(uniqid(rand(), true)), 10, 17)) . time(),
                'number'=> $number->number,
                'sms_type' => 3,
                'message' => $request->get('content'),
                'time_prepared' => date('Y-m-d H:i:s'),
                'request_id' => ''
            ];
            Queue::queue($dataQueue);
        }
        
        if ($response['status'] == 'Success') {
            return redirect('advisory')->with('message', 'Advisory '.$response['message']);
        }
        else {
            return redirect('advisory/create')->withErrors(array('An error occured while saving! Please try again.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
