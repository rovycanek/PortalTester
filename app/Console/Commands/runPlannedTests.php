<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use App\IP;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class runPlannedTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:runPlannedTests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $IPs= IP::where('when','<', Carbon::now())->get();
        foreach ($IPs as $IP) {
            var_dump($IP->when);
            if(!strcmp($IP->frequency,'daily')){
                $IP->when=Carbon::parse($IP->when)->addDays(1);
                $IP->save();
            }
            if(!strcmp($IP->frequency,'weekly')){
                $IP->when=Carbon::parse($IP->when)->addDays(7);
                $IP->save();
            }
            if(!strcmp($IP->frequency,'one time')){
                $IP->delete();
            }
        }
    }
}
