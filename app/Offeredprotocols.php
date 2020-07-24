<?php

namespace App;
use App\Test;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Styling;

use Illuminate\Database\Eloquent\Model;

class Offeredprotocols extends Model
{
    protected $table = 'offeredprotocols';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function runTest(String $adress, Int $testId)
    {
        $process2 = new Process(['curl','-I', $adress]);
        $process2->setTimeout(0);
        $process2->run();
	$terminalResults = explode("\n", $process2->getOutput());
	$server='';
	foreach ($terminalResults as $line) {
        	if(str_contains($line, 'erver:')){
		$server=str_replace(": ","</span>     ",join(" ",["<span style=\"font-weight:bold;font-family\: monospace;\">",$line]));
		}
        }

        //Start test
        $process = new Process(['./testssl.sh', '--protocols', '--quiet',$adress],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
        $process->setTimeout(0);
        $process->run();
        
        $Styling =new Styling();  
        //Format for DB save  
        $terminalResults = explode("\n", $Styling->cmdToTags($process->getOutput()));
        $started= 0;
        $databaseForm = array();
        for ($i = 0; $i < count($terminalResults); $i++) {
            if(str_contains($terminalResults[$i], 'Testing all')){ 
                array_push($databaseForm, rtrim($terminalResults[$i]));
                $save= 1;
                for ($l = $i; $l < count($terminalResults); $l++) {
                    if(str_contains($terminalResults[$l], 'Start')){ 
                            array_push($databaseForm, rtrim($terminalResults[$l]));
                    }
                    if(str_contains($terminalResults[$l], 'Testing protocols')){ 
                        $l=$l+1;
                        $save= 2;
                    }
                    if(str_contains($terminalResults[$l], 'Done')){ 
                        $save= 1;
                    }
                    if($save>1){ 
                        if(strlen(trim($terminalResults[$l]))>8){
                            if(!str_contains($terminalResults[$l], '-----------------')){
                                array_push($databaseForm, rtrim($terminalResults[$l]));
                            }
                        }
                    }
                }
                $i = $l;
            }
            else{
                if(str_contains($terminalResults[$i], 'Testing')){  
                    for ($j = $i+1; $j < count($terminalResults); $j++) {
                        if(strlen($terminalResults[$j])>8){
                            if(!str_contains($terminalResults[$j], '-----------------')){
                                array_push($databaseForm, rtrim($terminalResults[$j]));
                            }
                        }
                    }
                    $i = $j;
                }
                array_pop($databaseForm);
            }
        }
	array_unshift($databaseForm, $server);
        //Save to DB 
        foreach ($databaseForm as $line) {
            $offeredprotocols=new Offeredprotocols;
            $offeredprotocols->test_id=$testId;
            $offeredprotocols->data=$line;
            $offeredprotocols->save();
        }
        return $Styling->TagsToHtml($databaseForm);
    }
}
