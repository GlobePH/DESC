<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Response;

use App\Model\Core\Advisory;

class AdvisoryController extends Controller
{

    /**
     * 
     * @var Object/Collection
     */
    private $advisory;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->advisory = Advisory::all();
        return Response::json($this->advisory, 200);
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
        $this->advisory = new Advisory;
        $this->advisory->user_id    = $request->get('user_id');
        $this->advisory->cluster_id = $request->get('cluster_id');
        $this->advisory->name       = $request->get('name');
        $this->advisory->summary    = $request->get('summary');
        $this->advisory->status     = $request->get('status');
        if ($this->advisory->save()) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully saved!',
                'id'        => $this->advisory->id
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
        $this->advisory = Advisory::find($id);
        return Response::json($this->advisory, 200);
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
        if ($this->advisory = Advisory::find($id)) {
            $this->advisory->user_id    = $request->get('user_id');
            $this->advisory->cluster_id = $request->get('cluster_id');
            $this->advisory->name       = $request->get('name');
            $this->advisory->summary    = $request->get('summary');
            $this->advisory->status     = $request->get('status');
            if ($this->advisory->save()) {
                $return = [
                    'status'    => 'Success',
                    'message'   => 'Successfully updated!',
                    'id'        => $this->advisory->id
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
                'message'   => 'Id not found!'
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
        if (Advisory::destroy($id)) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully Deleted!',
                'id'        => $id
            ];
        }
        else {
            $return = [
                'status'    => 'Error',
                'message'   => 'Error in deleting'
            ];
        }
        return Response::json($return, 200);
    }
}
