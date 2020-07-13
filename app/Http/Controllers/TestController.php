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
use App\Styling;

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

       return view('tests.show')->with(['test' => $test,'serverhello' => $ServerHello,
       'securityHeaders' => $SecurityHeaders ,'handshakesimulation' => $HandshakeSimulation,
       'securitybreaches' => $SecurityBreaches,'offeredprotocols' => $OfferedProtocols,
       'ciphersperprotocol' => $CiphersPerProtocol]);

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
