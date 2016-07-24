<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Response;

use DB;
use App\Model\Core\User;
use App\Model\Core\UserType;

class UserController extends Controller
{

    /**
     * 
     * @var Collection/Object
     */
    private $user; 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user = User::with(['userDetail', 'cluster', 'userType'])->paginate(10);
        if (isset($_GET['q'])) {
            if ($_GET['q']) {
                    $this->user = User::with(['userDetail', 'cluster', 'userType'])
                    ->where('email', 'LIKE', $_GET['q'].'%')
                    ->orWhere('username', 'LIKE', $_GET['q'].'%')
                    ->paginate(10);
            }
        }
        return Response::json($this->user, 200);
    }

    /**
     * Get list of user types
     * @return Collection
     */
    public function types()
    {
        $this->user = UserType::all();
        return Response::json($this->user, 200);
    }

    /**
     * Retrieve random user id from the cluster id parameter
     * @param  integer $cluster_id 
     * @return Integer
     */
    public function assignRandom($cluster_id = 0)
    {
        $userCount = User::select('id')->where('cluster_id', '=', $cluster_id)->orderBy(DB::raw('RAND()'))->first();
        return $userCount;
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
        $this->user = new User;
        $this->user->user_type_id   = $request->get('user_type_id');
        $this->user->cluster_id     = $request->get('cluster_id');
        $this->user->email          = $request->get('email');
        $this->user->password       = bcrypt($request->get('password'));
        $this->user->username       = $request->get('username');
        $this->user->status         = $request->get('status');
        if ($this->user->save()) {
            $return = [
                'status'    => 'Success',
                'message'   => 'Successfully created',
                'id'        => $this->user->id
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
        if ($this->user = User::find($id)) {
            $return = $this->user;
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
        if ($this->user = User::find($id)) {
            $this->user->cluster_id     = $request->get('cluster_id');
            $this->user->password       = bcrypt($request->get('password'));
            $this->user->status         = $request->get('status');
            if ($this->user->save()) {
                $return = [
                    'status'    => 'Success',
                    'message'   => 'Successfully updated',
                    'id'        => $this->user->id
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
        if (User::destroy($id)) {
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
