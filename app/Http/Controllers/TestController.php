<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Test;
use App\SecurityHeaders;
use App\Handshakesimulation;
use App\Securitybreaches;
use App\Offeredprotocols;
use App\Serverhello;
use App\Ciphersperprotocol;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $tests= Test::where('user_id', $user_id )->orderBy('created_at','desc')->paginate(10);
        return view('pages.test')->with('tests', $tests);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
        {
        $this->validate($request, ['IP' => 'ip']);
        
        $test=new Test;
        $test->type='manual start';
        $test->subject=$request->IP;
        
        $test->user_id = auth()->user()->id;
        $test->save();
        return response()->json(['ID'=>$test->id]);
    }


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::find($id);
        if(auth()->user()->id !== $test->user_id){
            return redirect('/tests')->with('error', 'Unauthorized page');
        }
       
        return view('tests.show',['test' => $test,'serverhello' => $test->serverhello,
        'securityHeaders' => $test->securityHeaders,'handshakesimulation' => $test->handshakesimulation,
        'securitybreaches' => $test->securitybreaches,'offeredprotocols' => $test->offeredprotocols,
        'ciphersperprotocol' => $test->ciphersperprotocol]);
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
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }


}
