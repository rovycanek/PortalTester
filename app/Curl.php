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
        $process = new Process(['curl','-v' ,'--compressed', $adress]);
        $process->setTimeout(0);
        try {
            $process->mustRun();
        
            //Format for DB save  
            $terminalResults = explode("\n",  mb_convert_encoding($process->getErrorOutput() .$process->getOutput(), 'UTF-8','UTF-8'));
     
            $maxlengh=array();
            foreach ($terminalResults as $line) {
                foreach (str_split($line, 142) as $split) {
                    array_push($maxlengh, $split);
                }
            }

            //Save to DB 
            foreach ($maxlengh as $line) {
                    $curl=new Curl;
                    $curl->test_id=$testId;
                    $curl->data=$line;
                    $curl->save();
            }
            
            return $maxlengh;
        } catch (ProcessFailedException $exception) {
            return [$exception->getMessage()];
        }
    }

}
