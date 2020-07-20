<?php

namespace App;
use App\Test;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Styling;

use Illuminate\Database\Eloquent\Model;

class Nmap extends Model
{
    protected $table = 'nmap';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function runTest(String $adress, Int $testId)
    {
        //Start test
        $process = new Process(['nmap', '-Ap1-65535',str_replace("https://", "", $adress)]);
        $process->setTimeout(0);
        try {
            $process->mustRun();

            //Format for DB save  
            $terminalResults = explode("\n", $process->getOutput());
            $databaseForm = array();
            for ($i = 0; $i < count($terminalResults); $i++) {
                if(str_contains($terminalResults[$i], 'Starting')){  
                    for ($j = $i+1; $j < count($terminalResults); $j++) {
                        if(strlen($terminalResults[$j])>8){
                            array_push($databaseForm, rtrim($terminalResults[$j]));
                        }
                    }
                    $i = $j;
                }
            }
            //array_pop($databaseForm);

            //Save to DB 
            foreach ($databaseForm as $line) {
                    $nmap=new Nmap;
                    $nmap->test_id=$testId;
                    $nmap->data=$line;
                    $nmap->save();
            }
            return $databaseForm;
        } catch (ProcessFailedException $exception) {
            return [$exception->getMessage()];
        }
    }
}
