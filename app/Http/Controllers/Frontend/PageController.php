<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Curl;
use Config;

class PageController extends Controller
{

	/**
	 * General data of controller
	 * @var array
	 */
	public $data;

	/**
	 * Display index page
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Display dashboard page
	 * @return Response
	 */
	public function dashboard()
	{
		$this->data['title']	= Config::get('constants.title').' - Dashboard';
		return view('admin.dashboard')->with($this->data);
	}

	/**
	 * Display graphs page
	 * @return Response
	 */
	public function graphs()
	{
		$this->data['title']	= Config::get('constants.title').' - Graphs';
		return view('admin.graphs')->with($this->data);
	}

}
