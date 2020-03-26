<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SecurityHeaddersTestListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $process=new Process(['./testssl.sh', '--json-pretty', '--html', '--client-simulation', $request->IP],$cwd = '/opt/lampp/htdocs/PortalTester/app/Http/Controllers/testssl.sh');
        try {
            $process->mustRun();
            while ($process->isRunning()) {
                // waiting for process to finish
            }

        } catch (ProcessFailedException $exception) {
            echo $exception->getMessage();
        }
    }
}
