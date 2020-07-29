<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
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
        $IPs= IP::orderBy('user_id','desc')->paginate(15);
        $user = User::find($user_id);
        return view('admin.IPs.index')->with('ips', $IPs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.IPs.create');
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
        'email' => 'email',
        'ip' => 'ip'
            ]);
        $ip=new IP;
        $ip->frequency = $request->input('frequency');
        $ip->when =  join([$request->input('when')," ",$request->input('time'),":00"]);
        $ip->ip = $request->input('ip');
        $ip->email = $request->input('email');
        $ip->user_id = auth()->user()->id;
        $ip->save();
        return redirect('/admin/IPs')->with('success', 'Task Created');
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
        return view('admin.IPs.edit')->with('ip',$ip);
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
            'email' => 'email',
                ]);
        $ip=IP::find($id);
        $ip->frequency = $request->input('frequency');
        $ip->when =  join([$request->input('when')," ",$request->input('time'),":00"]);
        $ip->formateSubject($request->input('ip'));
        $ip->email = $request->input('email');
        $ip->save();

        return redirect('/admin/IPs')->with('success', 'Task updated');
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
         $ip->delete();
         return redirect('/admin/IPs')->with('success', 'Task removed');
    }
}
