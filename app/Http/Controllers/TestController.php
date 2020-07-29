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
use App\UrlRule;
use App\Nmap;
use App\Curl;

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
        return view('tests.index')->with('tests', $tests);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
        {
        $this->validate($request, ['IP' => new UrlRule()]);
        
        $test=new Test;
        $test->type='manual start';
        $test->formateSubject($request->IP);
        
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
       'ciphersperprotocol' => $CiphersPerProtocol,'curl'=>$test->curl,'nmap'=>$test->nmap]);
    }


    public function Handshakesimulation(Request $request)
    {
        $this->validate($request, [
            'IP' => new UrlRule()
            ]);
        $handshakesimulation=new Handshakesimulation;
        return response()->json(['headers'=>$handshakesimulation->runTest($request->testID)]);  
    }
        
        public function SecurityHeaders(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);

            $securityHeaders=new SecurityHeaders;
            $results=$securityHeaders->runTest($request->testID);
            return response()->json(['headersWith'=>$results[0],'headersWithout'=>$results[1]]);
        }

        public function Securitybreaches(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);
            $securitybreaches=new Securitybreaches;
            return response()->json(['headers'=>$securitybreaches->runTest($request->testID)]);    
        }

        public function Offeredprotocols(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);

            $offeredprotocols=new Offeredprotocols;
            return response()->json(['headers'=>$offeredprotocols->runTest($request->testID)]);  
        }
        
        public function Serverhello(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);

            $serverhello=new Serverhello;
            return response()->json(['headers'=>$serverhello->runTest($request->testID)]);  
        }
        
        public function Ciphersperprotocol(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);

            $ciphersperprotocol=new Ciphersperprotocol;
            return response()->json(['headers'=>$ciphersperprotocol->runTest($request->testID)]); 
        }

        public function Curl(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);

            $curl=new Curl;
            return response()->json(['headers'=>$curl->runTest($request->testID)]); 
        }

        public function Nmap(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);
            $nmap=new Nmap;
            return response()->json(['headers'=>$nmap->runTest($request->testID)]); 
        }
}
