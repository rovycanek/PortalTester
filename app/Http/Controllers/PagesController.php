<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Illuminate\Http\Request;
USE app\Events\runTestsEvent;
use Event;


use Illuminate\Http\Response;
class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to potal tester App';
        return view('pages.index')->with('title',$title);

    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        return view('pages.services');

    }

    public function test(Request $request){
        //event(new runTestsEvent());
        $this->validate($request, [
            'IP' => 'ip'
                ]);
        $process = new Process(['../app/Http/Controllers/shcheck.py', '-dj', $request->IP]);
        try {
            $process->mustRun();
            while ($process->isRunning()) {
                // waiting for process to finish
            }
            $headers = json_decode($process->getOutput(),true);
            
            return response()->json(['headers'=>$headers,'ip'=>$request->IP]);
          
        } catch (ProcessFailedException $exception) {
            echo $exception->getMessage();
        }
       
       

    }



}
