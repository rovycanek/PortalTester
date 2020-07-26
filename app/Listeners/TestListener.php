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
        $test->formateSubject($event->IP);
        
        $test->user_id = $event->user_id;
        $test->save();


        
        $securityHeaders=new SecurityHeaders;
        $results=$securityHeaders->runTest($test->id);
        $arrayNoHeadders=$results[1];
        $arrayWithHeadders=$results[0];

        $handshakesimulation=new Handshakesimulation;
        $Handshakesimulation=$handshakesimulation->runTest($test->id);

    
        
        $securitybreaches=new Securitybreaches; 
        $Securitybreaches=$securitybreaches->runTest($test->id);

        $offeredprotocols=new Offeredprotocols;
        $Offeredprotocols=$offeredprotocols->runTest($test->id);

        $serverhello=new Serverhello; 
        $ServerHello=$serverhello->runTest($test->id);

        $ciphersperprotocol=new Ciphersperprotocol; 
        $Ciphersperprotocol=$ciphersperprotocol->runTest($test->id);


        Mail::to($event->email)->send(new TestResults($arrayNoHeadders,$arrayWithHeadders,$Handshakesimulation,$Securitybreaches,$Offeredprotocols,$ServerHello,$Ciphersperprotocol, $event->IP));

    }
}