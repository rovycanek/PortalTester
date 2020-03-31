<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use Illuminate\Http\Request;
use Event;
use App\Events\runTestsEvent;


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
}
