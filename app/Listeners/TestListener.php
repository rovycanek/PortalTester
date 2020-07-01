<?php

namespace App\Listeners;

use App\Events\runTestsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\TestResults;
use Illuminate\Support\Facades\Mail;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use App\Test;
use App\SecurityHeaders;
use App\Handshakesimulation;
use App\Securitybreaches;
use App\Offeredprotocols;
use App\Serverhello;
use App\Ciphersperprotocol;

class TestListener implements ShouldQueue{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  runTestsEvent  $event
     * @return void
     */
    public function handle(runTestsEvent $event)
    {

        $test=new Test;
        $test->type='planned job';
        $test->subject=$event->IP;
        
        $test->user_id = $event->user_id;
        $test->save();




        $process = new Process(['./app/Http/Controllers/shcheck.py', '-d', $event->IP]);
        try {
            $process->mustRun();
            while ($process->isRunning()) {
                // waiting for process to finish
            }
            $headers = json_decode($process->getOutput(),true);
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
                    $securityHeaders->test_id=$test->id;
                    $securityHeaders->data=$arrayWithHeadders[$i];
                
                    $securityHeaders->type = true;
                    $securityHeaders->save();
                }
          
            }
            for ($i = 0; $i < count($arrayNoHeadders); $i++) {
                if(strlen($arrayNoHeadders[$i])>2){
                    $securityHeaders=new SecurityHeaders;
                    $securityHeaders->test_id=$test->id;
                    $securityHeaders->data=$arrayNoHeadders[$i];
                    $securityHeaders->type = false;
                    $securityHeaders->save();
                }

            }

            $process2 = new Process(['./testssl.sh', '--client-simulation', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process2->setTimeout(0);
            $process2->run();
            while ($process2->isRunning()) {
                // waiting for process to finish
            }
            $handShakes = explode("\n", $process2->getOutput());

            for ($i = 0; $i < count($handShakes); $i++) {
                if(strlen($handShakes[$i])>2){
                    $handshakesimulation=new Handshakesimulation;
                    $handshakesimulation->test_id=$test->id;
                    $handshakesimulation->data=$handShakes[$i];
                    $handshakesimulation->save();
                }
            }

            $process3 = new Process(['./testssl.sh', '--vulnerable', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process3->setTimeout(0);
            $process3->run();
            while ($process3->isRunning()) {
                // waiting for process to finish
            }
            $SecurityVulnerabilities = explode("\n", $process3->getOutput());

            for ($i = 0; $i < count($SecurityVulnerabilities); $i++) {
                if(strlen($SecurityVulnerabilities[$i])>2){
                    $securitybreaches=new Securitybreaches;
                    $securitybreaches->test_id=$test->id;
                    $securitybreaches->data=$SecurityVulnerabilities[$i];
                    $securitybreaches->save();
                }
            }


            $process4 = new Process(['./testssl.sh', '--protocols', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process4->setTimeout(0);
            $process4->run();
            while ($process4->isRunning()) {
                // waiting for process to finish
            }
            $ConnectionProtocols = explode("\n", $process4->getOutput());
            for ($i = 0; $i < count($ConnectionProtocols); $i++) {
                if(strlen($ConnectionProtocols[$i])>2){
                    $offeredprotocols=new Offeredprotocols;
                    $offeredprotocols->test_id=$test->id;
                    $offeredprotocols->data=$ConnectionProtocols[$i];
                    $offeredprotocols->save();
                }
            }
            
            $process5 = new Process(['./testssl.sh', '--server-defaults', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process5->setTimeout(0);
            $process5->run();
            while ($process5->isRunning()) {
                // waiting for process to finish
            }
            $ServerHello = explode("\n", $process5->getOutput());

            for ($i = 0; $i < count($ServerHello); $i++) {
                if(strlen($ServerHello[$i])>2){
                    $serverhello=new Serverhello;
                    $serverhello->test_id=$test->id;
                    $serverhello->data=$ServerHello[$i];
                    $serverhello->save();
                }
            }

            $process6 = new Process(['./testssl.sh', '--cipher-per-proto', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process6->setTimeout(0);
            $process6->run();
            while ($process6->isRunning()) {
                // waiting for process to finish
            }
            $CyphersPherProtocole = explode("\n", $process6->getOutput());


            for ($i = 0; $i < count($CyphersPherProtocole); $i++) {
                if(strlen($CyphersPherProtocole[$i])>2){
                    $ciphersperprotocol=new Ciphersperprotocol;
                    $ciphersperprotocol->test_id=$test->id;
                    $ciphersperprotocol->data=$CyphersPherProtocole[$i];
                    $ciphersperprotocol->save();
                }
            }

            Mail::to($event->email)->send(new TestResults($arrayNoHeadders,$arrayWithHeadders,$handShakes,$SecurityVulnerabilities,$ConnectionProtocols,$ServerHello,$CyphersPherProtocole, $event->IP));
        } catch (ProcessFailedException $exception) {
            echo $exception->getMessage();
        }
       
    }
}