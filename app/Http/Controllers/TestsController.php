<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Http\Request;
use Event;
use App\Events\runTestsEvent;

use Illuminate\Http\Response;
use App\SecurityHeaders;
use App\Handshakesimulation;
use App\Securitybreaches;
use App\Offeredprotocols;
use App\Serverhello;
use App\Ciphersperprotocol;
use App\Styling;
use App\UrlRule;



class TestsController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function HandshakeSimulation(Request $request)
    {
        $this->validate($request, [
            'IP' => new UrlRule()
            ]);
        $process = new Process(['./testssl.sh', '--client-simulation', '--quiet',$request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
        $process->setTimeout(0);
        $process->run();
        $Styling =new Styling();    
        $array = explode("\n", $Styling->cmdToTags($process->getOutput()));
        $myArray = array();
        for ($i = 0; $i < count($array); $i++) {
            if(str_contains($array[$i], 'Running client')){  
                for ($j = $i+1; $j < count($array); $j++) {
                    if(strlen($array[$j])>8){
                        array_push($myArray, $array[$j]);
                    }
                }
                $i = $j;
            }
        }
        array_pop($myArray);

        $array = $myArray;
        for ($i = 0; $i < count($array); $i++) {
            if(strlen($array[$i])>8){
                $securityHeaders=new Handshakesimulation;
                $securityHeaders->test_id=$request->testID;
                $securityHeaders->data=rtrim($array[$i]);
                $securityHeaders->save();
            }
        }


        return response()->json(['headers'=>$Styling->TagsToHtml($array)]);
       
    }
        
        public function securityH(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);
            $process = new Process(['../app/Http/Controllers/shcheck.py', '-g','-d', $request->IP]);
            $process->setTimeout(0);
            try {
                $process->mustRun();
                while ($process->isRunning()) {
                    // waiting for process to finish
                }
                $headers = explode("\n", $process->getOutput());

                $arrayNoHeadders=array();
                $arrayWithHeadders=array();
                for ($i = 0; $i < count($headers); $i++) {
                    if (strpos($headers[$i], ':') !== false){
                        array_push($arrayWithHeadders, $headers[$i]);
                    }else{
                        if(strlen($headers[$i])>2){
                            array_push($arrayNoHeadders, $headers[$i]);  
                        }
                    }
                }

                for ($i = 0; $i < count($arrayWithHeadders); $i++) {
                    if(strlen($arrayWithHeadders[$i])>2){
                        $securityHeaders=new SecurityHeaders;
                        $securityHeaders->test_id=$request->testID;
                        $securityHeaders->data=$arrayWithHeadders[$i];
                    
                        $securityHeaders->type = true;
                        $securityHeaders->save();
                    }
              
                }
                for ($i = 0; $i < count($arrayNoHeadders); $i++) {
                    if(strlen($arrayNoHeadders[$i])>2){
                        $securityHeaders=new SecurityHeaders;
                        $securityHeaders->test_id=$request->testID;
                        $securityHeaders->data=$arrayNoHeadders[$i];
                        $securityHeaders->type = false;
                        $securityHeaders->save();
                    }

                }


                return response()->json(['headersWith'=>$arrayWithHeadders,'headersWithout'=>$arrayNoHeadders,'ip'=>$request->IP]);
              
            } catch (ProcessFailedException $exception) {
                echo $exception->getMessage();
            }
           
           
    
        }

        public function SecurityVulnerabities(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);
            $process = new Process(['./testssl.sh', '--vulnerable', '--quiet',$request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process->setTimeout(0);
            $process->run();
            $Styling =new Styling();    
            $array = explode("\n", $Styling->cmdToTags($process->getOutput()));
            $myArray = array();
            for ($i = 0; $i < count($array); $i++) {
                if(str_contains($array[$i], 'Testing vulnerabilities')){
                    
                    for ($j = $i+1; $j < count($array); $j++) {
                        if(strlen($array[$j])>8){
                            array_push($myArray, $array[$j]);
                        }
                    }
                    $i = $j;
                }
            }
            array_pop($myArray);
    
            $array = $myArray;

            for ($i = 0; $i < count($array); $i++) {
                if(strlen($array[$i])>8){
                    $securityHeaders=new Securitybreaches;
                    $securityHeaders->test_id=$request->testID;
                    $securityHeaders->data=rtrim($array[$i]);
                    $securityHeaders->save();
                }
            }
            return response()->json(['headers'=>$Styling->TagsToHtml($array)]);
           
    
        }

        public function ConnectionProtocols(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);
            $process = new Process(['./testssl.sh', '--protocols', '--quiet',$request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process->setTimeout(0);
            $process->run();

        

            $Styling =new Styling();    
            $array = explode("\n", $Styling->cmdToTags($process->getOutput()));

            $myArray = array();
            for ($i = 0; $i < count($array); $i++) {
                if(str_contains($array[$i], 'Testing')){
                    
                    for ($j = $i+1; $j < count($array); $j++) {
                        if(strlen($array[$j])>8){
                            array_push($myArray, $array[$j]);
                        }
                    }
                    $i = $j;
                }
            }
            array_pop($myArray);
            

            $array = $myArray;
            for ($i = 0; $i < count($array); $i++) {
                if(strlen($array[$i])>8){
                    $securityHeaders=new Offeredprotocols;
                    $securityHeaders->test_id=$request->testID;
                    $securityHeaders->data=rtrim($array[$i]);
                    $securityHeaders->save();
                }
            }

            return response()->json(['headers'=>$Styling->TagsToHtml($array)]);
        }
        
        public function ServerHello(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);
            $process = new Process(['./testssl.sh', '--server-defaults', '--quiet',$request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process->setTimeout(0);
            $process->run();
            $Styling =new Styling();    
            $array = explode("\n", $Styling->cmdToTags($process->getOutput()));
            $myArray = array();
            for ($i = 0; $i < count($array); $i++) {
                if(str_contains($array[$i], 'Testing server')){
                    
                    for ($j = $i+1; $j < count($array); $j++) {
                        if(strlen($array[$j])>8){
                            array_push($myArray, $array[$j]);
                        }
                    }
                    $i = $j;
                }
            }
            array_pop($myArray);
    
            $array = $myArray;

            for ($i = 0; $i < count($array); $i++) {
                if(strlen($array[$i])>8){
                    $securityHeaders=new Serverhello;
                    $securityHeaders->test_id=$request->testID;
                    $securityHeaders->data=rtrim($array[$i]);
                    $securityHeaders->save();
                }
            }


            return response()->json(['headers'=>$Styling->TagsToHtml($array)]);
        }
        
        public function CiphersPherProtocol(Request $request){
            $this->validate($request, [
                'IP' => new UrlRule()
                    ]);
            $process = new Process(['./testssl.sh', '--cipher-per-proto', '--quiet','--color=3',$request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process->setTimeout(0);
            $process->run();
            $Styling =new Styling();    
            $array = explode("\n", $Styling->cmdToTags($process->getOutput()));
            $myArray = array();
            for ($i = 0; $i < count($array); $i++) {
                if(str_contains($array[$i], 'Testing')){
                    
                    for ($j = $i+1; $j < count($array); $j++) {
                        if(strlen($array[$j])>8 &&  !str_contains($array[$j], '-------------------------------------')){
                            array_push($myArray, $array[$j]);
                        }
                    }
                    $i = $j;
                }
            }
            array_pop($myArray);
    
            
            $array = $myArray;
            for ($i = 0; $i < count($array); $i++) {
                if(strlen($array[$i])>8){
                    $securityHeaders=new Ciphersperprotocol;
                    $securityHeaders->test_id=$request->testID;
                    $securityHeaders->data=rtrim($array[$i]);
                    $securityHeaders->save();
                }
            }
            return response()->json(['headers'=>$Styling->TagsToHtml($array)]);
        }

}
