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

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = Config::get('constants.title').' - Cluster Management';

        $urlQuery['page']           = (isset($_GET['page']) ? $_GET['page'] : '');
        $urlQuery['q']              = (isset($_GET['q']) ? $_GET['q'] : '');
        $this->data['clusters']     = Curl::to(url('api/modules/cluster').'?'.http_build_query($urlQuery))->asJson()->get();

        $this->data['message']      = '';
        if (Session::has('message')) {
            $this->data['message']  = Session::get('message');
        }

        $this->data['results']  = new LengthAwarePaginator($this->data['clusters']->data, $this->data['clusters']->total, 10, Paginator::resolveCurrentPage(), ['path' => url('cluster')]);

        return view('cluster.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title']        = Config::get('constants.title').' - Create Cluster';
        return view('cluster.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->data['cluster']      = [
            'name'          => $request->get('cluster_name'),
            'cluster_code'  => $request->get('cluster_code'),
            'description'   => $request->get('description')
        ];
        $response = Curl::to(url('api/modules/cluster'))->withData($this->data['cluster'])->asJson(true)->post();
        if ($response['status'] == 'Success') {
            return redirect('cluster')->with('message', 'Advisory '.$response['message']);
        }
        else {
            return redirect('cluster/create')->withErrors(array('An error occured while saving! Please try again.'));
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
