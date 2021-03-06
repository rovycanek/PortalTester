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

    public function runTest( Int $testId)
    {
        $test=Test::find($testId);
        $process = new Process(['curl','-v', '-L','-k','--compressed', $test->withHttps()]);  //need https://
        $process->setTimeout(0);
        try {
            $process->mustRun();
            //Format for DB save
            $terminalResults = explode("\n",  mb_convert_encoding($process->getErrorOutput() .$process->getOutput(), 'UTF-8','UTF-8'));
            $maxlengh=array();
            foreach ($terminalResults as $line) {
                while (mb_strlen( $line ) >0){
                        array_push($maxlengh, mb_substr( $line, 0, 142, 'utf-8'));
                        $line  = mb_substr( $line, 142, mb_strlen( $line ), 'utf-8' );
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
