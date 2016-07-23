<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Response;

use App\Model\Core\Ticket;

class TicketController extends Controller
{

    /**
     * 
     * @var Collection/Object
     */
    private $ticket;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->ticket = Ticket::all();
        return Response::json($this->ticket, 200);
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
        $this->ticket = new Ticket;
        $this->ticket->user_id       = $request->get('user_id');
        $this->ticket->cluster_id    = $request->get('cluster_id');
        $this->ticket->reference_id  = $request->get('reference_id');
        $this->ticket->ticket_status = $request->get('ticket_status');
        if ($this->ticket->save()) {
            $return = [
                'status'    => 'Succcess',
                'message'   => 'Successfully created',
                'id'        => $this->ticket->id
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
        if ($this->ticket = Ticket::find($id)) {
            $return = $this->ticket;
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
        if ($this->ticket = Ticket::find($id)) {
            $this->ticket->user_id       = $request->get('user_id');
            $this->ticket->cluster_id    = $request->get('cluster_id');
            $this->ticket->reference_id  = $request->get('reference_id');
            $this->ticket->ticket_status = $request->get('ticket_status');
            if ($this->ticket->save()) {
                $return = [
                    'status'    => 'Succcess',
                    'message'   => 'Successfully updated',
                    'id'        => $this->ticket->id
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
        if (Ticket::destroy($id)) {
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
