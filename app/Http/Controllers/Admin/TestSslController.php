<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class TestSslController extends Controller
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
        return view('admin.testSsl.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $process = new Process(['rm', '-r', 'testssl.sh'],$cwd = base_path() . '/app/Http/Controllers');
        $process->setTimeout(0);
        $process->run();
        while ($process->isRunning()) {
            // waiting for process to finish
        }
        $process2 = new Process(['git', 'clone', '--depth', '1', 'https://github.com/drwetter/testssl.sh.git'],$cwd = base_path() . '/app/Http/Controllers');
        $process2->setTimeout(0);
        $process2->run();
        while ($process2->isRunning()) {
            // waiting for process to finish
        }
        return redirect()->route('admin.testSsl.index')->with('success','Git repo was successfully cloned');
    }
}
