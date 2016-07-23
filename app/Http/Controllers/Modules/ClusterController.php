<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Response;

use App\Model\Core\Cluster;

class ClusterController extends Controller
{

    /**
     * 
     * @var Object/Collection
     */
    private $cluster;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->cluster = Cluster::all();
        return Response::json($this->cluster, 200);
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
        $this->cluster = new Cluster;
        $this->cluster->name            = $request->get('name');
        $this->cluster->description     = $request->get('description');
        $this->cluster->cluster_code    = $request->get('cluster_code');
        if ($this->cluster->save()) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully Created!',
                'id'        => $this->cluster->id
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
        if ($this->cluster = Cluster::find($id)) {
            $return = $this->cluster;
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
        if ($this->cluster = Cluster::find($id)) {
            $this->cluster->name            = $request->get('name');
            $this->cluster->description     = $request->get('description');
            $this->cluster->cluster_code    = $request->get('cluster_code');
            if ($this->cluster->save()) {
                $return = [
                    'status'    => 'Success',
                    'message'   => 'Successfully updated!',
                    'id'        => $this->cluster->id
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
        if (Cluster::destroy($id)) {
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
