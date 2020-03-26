<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE app\Events\runTestsEvent;

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

    public function test(Request $action){
        //event(new runTestsEvent());
        $Json='{"present": {"X-XSS-Protection": "1; mode=block", "X-Frame-Options": "DENY", "X-Content-Type-Options": "nosniff", "Strict-Transport-Security": "max-age=31536000;includeSubDomains"}, "missing": ["Public-Key-Pins", "Content-Security-Policy", "X-Permitted-Cross-Domain-Policies", "Referrer-Policy"]}';
        $headers = json_decode($Json,true);
        return response()->json(['headers'=>$headers]);
    }



}
