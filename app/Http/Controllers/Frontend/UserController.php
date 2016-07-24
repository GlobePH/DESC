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

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title']        = Config::get('constants.title').' - Account Management Management';

        $urlQuery['page']           = (isset($_GET['page']) ? $_GET['page'] : '');
        $urlQuery['q']              = (isset($_GET['q']) ? $_GET['q'] : '');
        $this->data['users']        = Curl::to(url('api/modules/user').'?'.http_build_query($urlQuery))->asJson()->get();

        $this->data['message']      = '';
        if (Session::has('message')) {
            $this->data['message']  = Session::get('message');
        }

        $this->data['results']  = new LengthAwarePaginator($this->data['users']->data, $this->data['users']->total, 10, Paginator::resolveCurrentPage(), ['path' => url('account')]);

        return view('account.index')->with($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title']        = Config::get('constants.title').' - Create Account';
        $this->data['user_types']   = Curl::to(url('api/modules/user/type'))->asJson()->get();
        $this->data['clusters']     = Curl::to(url('api/modules/cluster'))->asJson()->get();
        return view('account.create')->with($this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->data['user']         = [
            'user_type_id'          => $request->get('user_type'),
            'cluster_id'            => $request->get('cluster'),
            'email'                 => $request->get('email'),
            'password'              => $request->get('password'),
            'username'              => strtolower($request->get('first_name')).'.'.strtolower($request->get('last_name')),
            'status'                => 1
        ];
        $userResponse = Curl::to(url('api/modules/user'))->withData($this->data['user'])->asJson(true)->post();
        if ($userResponse['status'] == 'Success') {
            $this->data['detail']   = [
                'user_id'           => $userResponse['id'],
                'first_name'        => ucwords($request->get('first_name')),
                'last_name'         => ucwords($request->get('last_name')),
                'full_name'         => ucwords($request->get('first_name')).' '.ucwords($request->get('last_name')),
                'address'           => $request->get('address'),
                'province'          => $request->get('province'),
                'city'              => $request->get('city'),
                'avatar'            => ''
            ];
            $detailResponse = Curl::to(url('api/modules/user-detail'))->withData($this->data['detail'])->asJson(true)->post();
            if ($detailResponse['status'] == 'Success') {
                return redirect('account')->with('message', 'Advisory '.$detailResponse['message']);
            }
            else {
                return redirect('account')->withErrors(array('An error occured while saving! Please try again.'));
            }
        }
        else {
            return redirect('account/create')->withErrors(array('An error occured while saving! Please try again.'));
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
