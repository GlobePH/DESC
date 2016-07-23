<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Response;

use App\Model\Core\ContactNumberGroup;

class ContactNumberGroupController extends Controller
{

    /**
     * 
     * @var Collection/Object
     */
    private $group;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->group = ContactNumberGroup::all();
        return Response::json($this->group, 200);
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
        $this->group = new ContactNumberGroup;
        $this->group->group_name    = $request->get('name');
        if ($this->group->save()) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully Created',
                'id'        => $this->group->id
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
        if ($this->group = ContactNumberGroup::find($id)) {
            $return = $this->group;
        }
        else {
            $return = [
                'status'    => 'Error',
                'message'   => 'Id not found'
            ];
        }
        return Response::json($this->group, 200);
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
        if ($this->group = ContactNumberGroup::find($id)) {
            $this->group->group_name = $request->get('name');
            if ($this->group->save()) {
                $return = [
                    'status'    => 'Success',
                    'message'   => 'Successfully Updated',
                    'id'        => $this->group->id
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
                'message'   => 'Error in updating'
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
        if (ContactNumberGroup::destroy($id)) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully deleted!',
                'id'        =>  $id
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
