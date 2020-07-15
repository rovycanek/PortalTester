<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginLog;

class LoginLogController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $IPs= LoginLog::where('user_id', $user_id )->orderBy('created_at','desc')->paginate(10);
        return view('login.index')->with('ips', $IPs);
    }
}
