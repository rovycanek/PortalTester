<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Http\Request;
use Event;
use App\Events\runTestsEvent;

use Illuminate\Http\Response;

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
        $process = new Process(['./testssl.sh', '--client-simulation', $request->IP],$cwd = '/opt/lampp/htdocs/PortalTester/app/Http/Controllers/testssl.sh');
        $process->run();
        $array = explode("\n", $process->getOutput());
        return response()->json(['headers'=>$array]);
       
    }
        
        public function securityH(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['../app/Http/Controllers/shcheck.py', '-dj', $request->IP]);
            try {
                $process->mustRun();
                while ($process->isRunning()) {
                    // waiting for process to finish
                }
                $headers = json_decode($process->getOutput(),true);
                
                return response()->json(['headers'=>$headers,'ip'=>$request->IP]);
              
            } catch (ProcessFailedException $exception) {
                echo $exception->getMessage();
            }
           
           
    
        }

        public function SecurityVulnerabities(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['./testssl.sh', '--vulnerable', $request->IP],$cwd = '/opt/lampp/htdocs/PortalTester/app/Http/Controllers/testssl.sh');
            $process->run();
            $array = explode("\n", $process->getOutput());
            return response()->json(['headers'=>$array]);
           
    
        }

        public function ConnectionProtocols(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['./testssl.sh', '--protocols', $request->IP],$cwd = '/opt/lampp/htdocs/PortalTester/app/Http/Controllers/testssl.sh');
            $process->run();
            $array = explode("\n", $process->getOutput());
            return response()->json(['headers'=>$array]);
        }
        
        public function ServerHello(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['./testssl.sh', '--server-defaults', $request->IP],$cwd = '/opt/lampp/htdocs/PortalTester/app/Http/Controllers/testssl.sh');
            $process->run();
            $array = explode("\n", $process->getOutput());
            return response()->json(['headers'=>$array]);
        }
        
        public function CiphersPherProtocol(Request $request){
            $this->validate($request, [
                'IP' => 'ip'
                    ]);
            $process = new Process(['./testssl.sh', '--cipher-per-proto', $request->IP],$cwd = '/opt/lampp/htdocs/PortalTester/app/Http/Controllers/testssl.sh');
            $process->run();
            $array = explode("\n", $process->getOutput());
            return response()->json(['headers'=>$array]);
        }

}
