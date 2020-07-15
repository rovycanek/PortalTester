<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\IP;
use App\UrlRule;

class IPsController extends Controller
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
        $IPs= IP::where('user_id', $user_id )->orderBy('ip','desc')->paginate(5);
        $user = User::find($user_id);
        return view('IPs.index')->with('ips', $IPs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('IPs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'frequency' => 'required',
        'time'=> 'date_format:H:i',
        'when'=> 'date',
        'email' => 'email:rfc,dns',
        'ip' => new UrlRule()
            ]);
        $ip=new IP;
        $ip->frequency = $request->input('frequency');
        $ip->when =  join([$request->input('when')," ",$request->input('time'),":00"]);
        $ip->ip = $request->input('ip');
        $ip->email = $request->input('email');
        $ip->user_id = auth()->user()->id;
        $ip->save();
        return redirect('/IPs')->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/IPs');
        $ip = IP::find($id);
        return view('IPs.show')->with('ip',$ip);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ip = IP::find($id);
        if(auth()->user()->id !== $ip->user_id){
            return redirect('/IPs')->with('error', 'Unauthorized page');
        }
        return view('IPs.edit')->with('ip',$ip);
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
        $this->validate($request, [
            'frequency' => 'required',
            'time'=> 'date_format:H:i',
            'when'=> 'date',
            'ip' => new UrlRule(),
            'email' => 'email:rfc,dns',
                ]);
        $ip=IP::find($id);
        $ip->frequency = $request->input('frequency');
        $ip->when =  join([$request->input('when')," ",$request->input('time'),":00"]);
        $ip->ip = $request->input('ip');
        $ip->email = $request->input('email');
        $ip->save();
        return redirect('/IPs')->with('success', 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ip=IP::find($id);
        if(auth()->user()->id !== $ip->user_id){
            return redirect('/IPs')->with('error', 'Unauthorized operation');
        }
        $ip->delete();
        return redirect('/IPs')->with('success', 'Task removed');
    }
}