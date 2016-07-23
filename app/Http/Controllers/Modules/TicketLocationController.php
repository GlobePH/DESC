<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Response;

use App\Model\Core\TicketLocation;

class TicketLocationController extends Controller
{

    /**
     * 
     * @var Collection/Object
     */
    private $ticket_location;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->ticket_location = TicketLocation::all();
        return Response::json($this->ticket_location, 200);
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
        $this->ticket_location = new TicketLocation;
        $this->ticket_location->ticket_id   = $request->get('ticket_id');
        $this->ticket_location->latitude    = $request->get('latitude');
        $this->ticket_location->longitude   = $request->get('longitude');
        $this->ticket_location->location_details = $request->get('location_details');
        if ($this->ticket_location->save()) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Succesfully Created'
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
        if ($this->ticket_location = TicketLocation::find($id)) {
            $return = $this->ticket_location;
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
        if ($this->ticket_location = TicketLocation::find($id)) {
            $this->ticket_location->ticket_id   = $request->get('ticket_id');
            $this->ticket_location->latitude    = $request->get('latitude');
            $this->ticket_location->longitude   = $request->get('longitude');
            $this->ticket_location->location_details = $request->get('location_details');
            if ($this->ticket_location->save()) {
                $return = [
                    'status'    => 'Success',
                    'message'   => 'Succesfully updated'
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
        if (TicketLocation::destroy($id)) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully deleted',
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
