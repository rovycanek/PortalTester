<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Illuminate\Http\Request;
use Event;
use Gate;
use App\Events\runTestsEvent;


use Illuminate\Http\Response;
class PagesController extends Controller
{
    public function index(){
        if(Gate::denies('run-test')){
            return redirect(route('home'));
        }

        $title = 'Welcome to potal tester App';
        return view('pages.index')->with('title',$title);
    }

    public function about(){
        return view('pages.about');
    }
}
