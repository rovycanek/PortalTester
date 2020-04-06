<?php

namespace App\Listeners;

use App\Events\runTestsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\TestResults;
use Illuminate\Support\Facades\Mail;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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
        $process = new Process(['./app/Http/Controllers/shcheck.py', '-dj', $event->IP]);
        try {
            $process->mustRun();
            while ($process->isRunning()) {
                // waiting for process to finish
            }
            $headers = json_decode($process->getOutput(),true);
            
            $process2 = new Process(['./testssl.sh', '--client-simulation', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process2->setTimeout(0);
            $process2->run();
            while ($process2->isRunning()) {
                // waiting for process to finish
            }
            $handShakes = explode("\n", $process2->getOutput());

            $process3 = new Process(['./testssl.sh', '--vulnerable', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process3->setTimeout(0);
            $process3->run();
            while ($process3->isRunning()) {
                // waiting for process to finish
            }
            $SecurityVulnerabilities = explode("\n", $process3->getOutput());

            $process4 = new Process(['./testssl.sh', '--protocols', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process4->setTimeout(0);
            $process4->run();
            while ($process4->isRunning()) {
                // waiting for process to finish
            }
            $ConnectionProtocols = explode("\n", $process4->getOutput());
            
            $process5 = new Process(['./testssl.sh', '--server-defaults', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process5->setTimeout(0);
            $process5->run();
            while ($process5->isRunning()) {
                // waiting for process to finish
            }
            $ServerHello = explode("\n", $process5->getOutput());
            $process6 = new Process(['./testssl.sh', '--cipher-per-proto', $event->IP],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
            $process6->setTimeout(0);
            $process6->run();
            while ($process6->isRunning()) {
                // waiting for process to finish
            }
            $CyphersPherProtocole = explode("\n", $process6->getOutput());
            Mail::to($event->email)->send(new TestResults($headers,$handShakes,$SecurityVulnerabilities,$ConnectionProtocols,$ServerHello,$CyphersPherProtocole, $event->IP));
        } catch (ProcessFailedException $exception) {
            echo $exception->getMessage();
        }
       
    }
}