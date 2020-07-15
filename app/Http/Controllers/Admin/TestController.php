<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Test;
use App\SecurityHeaders;
use App\Handshakesimulation;
use App\Securitybreaches;
use App\Offeredprotocols;
use App\Serverhello;
use App\Ciphersperprotocol;
use App\Styling;
use DataTables;

class TestController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $tests= Test::orderBy('created_at','desc')->paginate(10);
        return view('admin.tests.index')->with('tests', $tests);
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
        

        $Styling = new Styling();  
        
        $ServerHello =$test->serverhello;
        foreach ($ServerHello as $Hello){
            $Hello->data =  $Styling->TagsToHtml($Hello->data);
        }

        $SecurityHeaders=$test->securityHeaders;
        foreach ($SecurityHeaders as $SecurityHeader){
            $SecurityHeader->data =  $Styling->TagsToHtml($SecurityHeader->data);
        }

        $HandshakeSimulation=$test->handshakesimulation;
        foreach ($HandshakeSimulation as $Handshake){
            $Handshake->data =  $Styling->TagsToHtml($Handshake->data);
        }


        $SecurityBreaches=$test->securitybreaches;
        foreach ($SecurityBreaches as $SecurityBreach){
            $SecurityBreach->data =  $Styling->TagsToHtml($SecurityBreach->data);
        }

        $OfferedProtocols=$test->offeredprotocols;
        foreach ($OfferedProtocols as $OfferedProtocol){
            $OfferedProtocol->data =  $Styling->TagsToHtml($OfferedProtocol->data);
        }


        $CiphersPerProtocol=$test->ciphersperprotocol;
        foreach ($CiphersPerProtocol as $Ciphers){
            $Ciphers->data =  $Styling->TagsToHtml($Ciphers->data);
        }

       return view('admin.tests.show')->with(['test' => $test,'serverhello' => $ServerHello,
       'securityHeaders' => $SecurityHeaders ,'handshakesimulation' => $HandshakeSimulation,
       'securitybreaches' => $SecurityBreaches,'offeredprotocols' => $OfferedProtocols,
       'ciphersperprotocol' => $CiphersPerProtocol]);

    }

}
