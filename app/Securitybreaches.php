<?php

namespace App;
use App\Test;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Styling;

use Illuminate\Database\Eloquent\Model;

class Securitybreaches extends Model
{
    protected $table = 'securitybreaches';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function runTest(String $adress, Int $testId)
    {
        //Start test
        $process = new Process(['./testssl.sh', '--vulnerable', '--quiet',$adress],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');

        $process->setTimeout(0);
        $process->run();

        $Styling =new Styling();  
        //Format for DB save  
        $terminalResults = explode("\n", $Styling->cmdToTags($process->getOutput()));
        $databaseForm = array();
        for ($i = 0; $i < count($terminalResults); $i++) {
            if(str_contains($terminalResults[$i], 'Testing vulnerabilities')){  
                for ($j = $i+1; $j < count($terminalResults); $j++) {
                    if(strlen($terminalResults[$j])>8){
                        array_push($databaseForm, rtrim($terminalResults[$j]));
                    }
                }
                $i = $j;
            }
        }
        array_pop($databaseForm);

        //Save to DB 
        foreach ($databaseForm as $line) {
            $securitybreaches=new Securitybreaches;
            $securitybreaches->test_id=$testId;
            $securitybreaches->data=$line;
            $securitybreaches->save();
        }
        return $Styling->TagsToHtml($databaseForm);
    }
}
