<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Http\Request;
use Event;
use App\Events\runTestsEvent;

use Illuminate\Http\Response;

class TestsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('IPs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = 'Welcome to potal tester App';
        $this->validate($request, [
        'IP' => 'ip'
            ]);
        
        event(new runTestsEvent());
        $process = new Process(['../app/Http/Controllers/shcheck.py', '-dj', $request->IP]);
        
        $process2 = new Process(['./testssl.sh', '--json-pretty', '--html', '--client-simulation', $request->IP],$cwd = '/opt/lampp/htdocs/PortalTester/app/Http/Controllers/testssl.sh');
        try {
            $process->mustRun();
            $process2->mustRun();
            while ($process->isRunning()) {
                // waiting for process to finish
            }
           // while ($process2->isRunning()) {
                // waiting for process to finish
            //}
            $headers = json_decode($process->getOutput(),true);
            //$doc = new DOMDocument();
            //$doc->loadHTMLFile("/opt/lampp/htdocs/PortalTester/app/Http/Controllers/testssl.sh/195.178.88.129_p443-20200322-1547.html");
           // echo $doc->saveHTML();
            $data= array('title'=> $title,
            'headers'=> $headers);
            
            return view('pages.index')->with($data);
            //view('pages.index')->with('headers',$headers);
             //echo $process->getOutput();
        } catch (ProcessFailedException $exception) {
            echo $exception->getMessage();
        }
        


       

       //print_r(get_headers('https://www.google.com/', 1));
         
      // return Redirect::back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
