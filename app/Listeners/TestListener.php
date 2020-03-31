<?php

namespace App\Listeners;

use App\Events\runTestsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
class TestListener
{
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
                dd($headers);
              
            } catch (ProcessFailedException $exception) {
                echo $exception->getMessage();
            }
       
    }
}
