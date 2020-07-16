<?php

namespace App;
use App\Test;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Styling;

use Illuminate\Database\Eloquent\Model;

class Ciphersperprotocol extends Model
{
    protected $table = 'ciphersperprotocol';
    public $timestamps = false;
    public $primaryKey = 'id';

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    public function runTest(String $adress, Int $testId)
    {
        //Start test
        $process = new Process(['./testssl.sh', '--cipher-per-proto', '--quiet','--color=3',$adress],$cwd = base_path() . '/app/Http/Controllers/testssl.sh');
        $process->setTimeout(0);
        $process->run();
        
        $Styling =new Styling();  
        //Format for DB save  
        $terminalResults = explode("\n", $Styling->cmdToTags($process->getOutput()));
        
        $databaseForm = array();
        for ($i = 0; $i < count($terminalResults); $i++) {
            if(str_contains($terminalResults[$i], 'Testing')){  
                for ($j = $i+1; $j < count($terminalResults); $j++) {
                    if(strlen($terminalResults[$j])>8 &&  !str_contains($terminalResults[$j], '-------------------------------------')){
                        array_push($databaseForm, rtrim($terminalResults[$j]));
                    }
                }
                $i = $j;
            }
        }
        array_pop($databaseForm);

        //Save to DB 
        foreach ($databaseForm as $line) {
            $ciphersperprotocol=new Ciphersperprotocol;
            $ciphersperprotocol->test_id=$testId;
            $ciphersperprotocol->data=$line;
            $ciphersperprotocol->save();
        }
        return $Styling->TagsToHtml($databaseForm);
    }
}
