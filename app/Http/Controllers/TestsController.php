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
        'IP' => 'ip'
            ]);
        $process = new Process(['./testssl.sh', '--client-simulation', $request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
        $process->setTimeout(0);
        $process->run();
        $array = explode("\n", $process->getOutput());
        for ($i = 0; $i < count($array); $i++) {
            if(strlen($array[$i])>8){
                $securityHeaders=new Handshakesimulation;
                $securityHeaders->test_id=$request->testID;
                $securityHeaders->data=rtrim($array[$i]);
                $securityHeaders->save();
            }
        }
        return response()->json(['headers'=>$array]);
       
    }
        
        public function securityH(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['../app/Http/Controllers/shcheck.py', '-d', $request->IP]);
            $process->setTimeout(0);
            try {
                $process->mustRun();
                while ($process->isRunning()) {
                    // waiting for process to finish
                }
                //$headers = json_decode($process->getOutput(),true);
                $headers = explode("\n", $process->getOutput());

                $arrayNoHeadders=array();
                $arrayWithHeadders=array();
                for ($i = 0; $i < count($headers); $i++) {
                    if (strpos($headers[$i], ':') !== false){
                        array_push($arrayWithHeadders, $headers[$i]);
                    }else{
                        array_push($arrayNoHeadders, $headers[$i]);  
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
                'IP' => 'ip'
                    ]);
            $process = new Process(['./testssl.sh', '--vulnerable', $request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process->setTimeout(0);
            $process->run();
            $array = explode("\n", $process->getOutput());

            for ($i = 0; $i < count($array); $i++) {
                if(strlen($array[$i])>8){
                    $securityHeaders=new Securitybreaches;
                    $securityHeaders->test_id=$request->testID;
                    $securityHeaders->data=rtrim($array[$i]);
                    $securityHeaders->save();
                }
            }
            return response()->json(['headers'=>$array]);
           
    
        }

        public function ConnectionProtocols(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['./testssl.sh', '--protocols', $request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process->setTimeout(0);
            $process->run();
            $array = explode("\n", $process->getOutput());
            for ($i = 0; $i < count($array); $i++) {
                if(strlen($array[$i])>8){
                    $securityHeaders=new Offeredprotocols;
                    $securityHeaders->test_id=$request->testID;
                    $securityHeaders->data=rtrim($array[$i]);
                    $securityHeaders->save();
                }
            }

            return response()->json(['headers'=>$array]);
        }
        
        public function ServerHello(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['./testssl.sh', '--server-defaults', $request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process->setTimeout(0);
            $process->run();
            $array = explode("\n", $process->getOutput());

            for ($i = 0; $i < count($array); $i++) {
                if(strlen($array[$i])>8){
                    $securityHeaders=new Serverhello;
                    $securityHeaders->test_id=$request->testID;
                    $securityHeaders->data=rtrim($array[$i]);
                    $securityHeaders->save();
                }
            }


            return response()->json(['headers'=>$array]);
        }
        
        public function CiphersPherProtocol(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['./testssl.sh', '--cipher-per-proto', $request->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process->setTimeout(0);
            $process->run();
            $array = explode("\n", $process->getOutput());

            for ($i = 0; $i < count($array); $i++) {
                if(strlen($array[$i])>8){
                    $securityHeaders=new Ciphersperprotocol;
                    $securityHeaders->test_id=$request->testID;
                    $securityHeaders->data=rtrim($array[$i]);
                    $securityHeaders->save();
                }
            }

            return response()->json(['headers'=>$array]);
        }

}
