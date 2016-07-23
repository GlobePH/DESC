<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Response;

use App\Model\Core\ContactNumber;

class ContactNumberController extends Controller
{
    /**
     * 
     * @var Colleciton/Object
     */
    private $contact_number;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->contact_number = ContactNumber::all();
        return Response::json($this->contact_number, 200);
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
        $this->contact_number = new ContactNumber;
        $this->contact_number->number       = $request->get('number');
        $this->contact_number->group_id     = ($request->get('group_id') ? $request->get('group_id') : 0);
        $this->contact_number->cluster_id    = $request->get('cluster_id');
        $this->contact_number->status       = ($request->get('status') ? $request->get('status') : 1);
        $this->contact_number->save();
        if ($this->contact_number->save()) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully Created!',
                'id'        => $this->contact_number->id
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
        if ($this->contact_number = ContactNumber::find($id)) {
            $return = $this->contact_number;
        }
        else {
            $return = [
                'status'    => 'Error',
                'message'   => 'Id not found!'
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
        if ($this->contact_number = ContactNumber::find($id)) {
            $this->contact_number->number       = $request->get('number');
            $this->contact_number->group_id     = ($request->get('group_id') ? $request->get('group_id') : 0);
            $this->contact_number->status       = ($request->get('status') ? $request->get('status') : 1);
            $this->contact_number->save();
            if ($this->contact_number->save()) {
                $return = [
                    'status'    => 'Success',
                    'message'   => 'Successfully Updated!',
                    'id'        => $this->contact_number->id
                ];
            }
            else {
                $return = [
                    'status'    => 'Error',
                    'message'   => 'Error in update'
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
        if (ContactNumber::destroy($id)) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully Deleted!',
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
