<?php

namespace App;
use App\Test;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


use Illuminate\Database\Eloquent\Model;

class SecurityHeaders extends Model
{
    protected $table = 'securityheaders';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function runTest(String $adress, Int $testId){
            $process = new Process(['./shcheck.py', '-g','-d', $adress],$cwd = base_path() . '/app/Http/Controllers');
            $process->setTimeout(0);
            $process->run();

            $terminalResults = explode("\n", $process->getOutput());

            $arrayNoHeadders=array();
            $arrayWithHeadders=array();
            for ($i = 0; $i < count($terminalResults); $i++) {
                if(strlen($terminalResults[$i])>2){
                    if (strpos($terminalResults[$i], ':') !== false){
                        array_push($arrayWithHeadders, $terminalResults[$i]);
                    }else{
                            array_push($arrayNoHeadders, $terminalResults[$i]);  
                    }
                }
            }

            for ($i = 0; $i < count($arrayWithHeadders); $i++) {
                    $securityHeaders=new SecurityHeaders;
                    $securityHeaders->test_id=$testId;
                    $securityHeaders->data=$arrayWithHeadders[$i];
                    $securityHeaders->type = true;
                    $securityHeaders->save();
            }
            for ($i = 0; $i < count($arrayNoHeadders); $i++) {
                    $securityHeaders=new SecurityHeaders;
                    $securityHeaders->test_id=$testId;
                    $securityHeaders->data=$arrayNoHeadders[$i];
                    $securityHeaders->type = false;
                    $securityHeaders->save();
            }
            return [ $arrayWithHeadders,  $arrayNoHeadders];
    }
}
