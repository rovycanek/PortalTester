<?php

namespace App;
use App\Test;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Illuminate\Database\Eloquent\Model;

class Curl extends Model
{
    protected $table = 'curl';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function runTest(String $adress, Int $testId)
    {
        //Start test
        $process = new Process(['curl','-v', '"Content-Type: application/x-www-form-urlencoded; charset=utf-8"','--data-ascii', '"content=derinhält&date=asdf"', $adress]);
        $process->setTimeout(0);
        try {
            $process->mustRun();
        
            //Format for DB save  
            $terminalResults = explode("\n",  mb_convert_encoding($process->getOutput(), 'UTF-8','UTF-8'));
            array_push($terminalResults , explode("\n",  mb_convert_encoding($process->getErrorOutput(), 'UTF-8','UTF-8')));

            //Save to DB 
            foreach ($terminalResults as $line) {
                    $curl=new Curl;
                    $curl->test_id=$testId;
                    $curl->data=$line;
                    $curl->save();
            }
            return [$terminalResults];

        } catch (ProcessFailedException $exception) {
            return [$exception->getMessage()];
        }
    }

}
