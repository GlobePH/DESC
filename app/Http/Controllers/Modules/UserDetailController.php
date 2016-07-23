<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Response;

use App\Model\Core\UserDetail;

class UserDetailController extends Controller
{

    /**
     * 
     * @var Collection/Object
     */
    private $detail;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->detail = UserDetail::all();
        return Response::json($this->detail, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->detail = new UserDetail;
        $this->detail->user_id      = $request->get('user_id');
        $this->detail->first_name   = ucwords($request->get('first_name'));
        $this->detail->last_name    = ucwords($request->get('last_name'));
        $this->detail->full_name    = ucfirst($request->get('first_name')).' '.ucfirst($request->get('last_name'));
        $this->detail->avatar       = $request->get('avatar');
        $this->detail->address      = $request->get('address');
        $this->detail->province     = $request->get('province');
        $this->detail->city         = $request->get('city');
        if ($this->detail->save()) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully created',
                'id'        => $this->detail->id
            ];
        }
        else {
            $return = [
                'status'    => 'Error',
                'message'   => 'Error in saving'
            ];
        }
        return Response::json($return, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->detail = UserDetail::find($id)) {
            $return = $this->detail;
        }
        else {
            $return = [
                'status'    => 'Error',
                'message'   => 'Id not found'
            ];
        }
        return Response::json($return, 200);
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
        if ($this->detail = UserDetail::find($id)) {
            $this->detail->first_name   = ucwords($request->get('first_name'));
            $this->detail->last_name    = ucwords($request->get('last_name'));
            $this->detail->full_name    = ucfirst($request->get('first_name')).' '.ucfirst($request->get('last_name'));
            $this->detail->avatar   = $request->get('avatar');
            $this->detail->address  = $request->get('address');
            $this->detail->province = $request->get('province');
            $this->detail->city     = $request->get('city');
            if ($this->detail->save()) {
                $return = [
                    'status'    => 'Success',
                    'message'   => 'Successfully updated',
                    'id'        => $this->detail->id
                ];
            }
            else {
                $return = [
                    'status'    => 'Error',
                    'message'   => 'Error in updating'
                ];
            }
        }
        else {
            $return = [
                'status'    => 'Error',
                'message'   => 'Id not found'
            ];
        }
        return Response::json($return, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (UserDetail::destroy($id)) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully Deleted',
                'id'        => $id
            ];
        }
        else {
            $return = [
                'status'    => 'Error',
                'message'   => 'Id not found'
            ];
        }
        return Response::json($return, 200);
    }
}
