<?php

namespace App;
use App\Test;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Styling;

use Illuminate\Database\Eloquent\Model;

class Serverhello extends Model
{
    protected $table = 'serverhello';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function runTest(String $adress, Int $testId)
    {
        //Start test
        $process = new Process(['./testssl.sh', '--server-defaults', '--quiet',$adress],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
        $process->setTimeout(0);
        $process->run();
        
        $Styling =new Styling();  
        //Format for DB save  
        $terminalResults = explode("\n", $Styling->cmdToTags($process->getOutput()));
        
        $databaseForm = array();
        for ($i = 0; $i < count($terminalResults); $i++) {
            if(str_contains($terminalResults[$i], 'Testing all')){ 
                array_push($databaseForm, rtrim($terminalResults[$i]));
                $save= 1;
                for ($l = $i; $l < count($terminalResults); $l++) {
                    if(str_contains($terminalResults[$l], 'Start')){ 
                        array_push($databaseForm, rtrim($terminalResults[$l]));
                    }
                    if(str_contains($terminalResults[$l], 'Testing server')){ 
                        $l=$l+1;
                        $save= 2;
                    }
                    if(str_contains($terminalResults[$l], 'Done')){ 
                        $save= 1;
                    }
                    if($save>1){ 
                        if(strlen(trim($terminalResults[$l]))>8){
                            array_push($databaseForm, rtrim($terminalResults[$l]));
                        }
                    }
                }
                $i = $l;
            }
            else{
                if(str_contains($terminalResults[$i], 'Testing server')){  
                    for ($j = $i+1; $j < count($terminalResults); $j++) {
                        if(strlen($terminalResults[$j])>8){
                            array_push($databaseForm, rtrim($terminalResults[$j]));
                        }
                    }
                    $i = $j;
                }
                array_pop($databaseForm);
            }
        }


        //Save to DB 
        foreach ($databaseForm as $line) {
            $serverhello=new Serverhello;
            $serverhello->test_id=$testId;
            $serverhello->data=$line;
            $serverhello->save();
        }
        return $Styling->TagsToHtml($databaseForm);
    }
}
