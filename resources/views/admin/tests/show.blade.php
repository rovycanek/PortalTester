@extends('layouts.app')
@section('content')
    <div class="card card-default">
    <div class="card-header"><H3>Test of {{$test->subject}}</H3></div>
    <div class="card-body">

        <div class="card card-default" style="margin-bottom: 10px;">
            <div class="card-header"><H4>Basic info</H4></div>
            <div class="card-body">
                <div><small>Test was started at: <b>{{$test->created_at}} </b></small></div>
                <div><small>Tested site: <b>{{$test->subject}} </b></small></div>
                <div><small>Test type: <b>{{$test->type}} </b></small></div>
                <div><small>Test owner: <b>{{$test->user->name}} </b></small></div>
            </div>
        </div>

        @if(count($securityHeaders)>0)
        <div class="card card-default" style="margin-bottom: 10px;">
            <div class="card-header"><H4>Security headers</H4></div>
            <div class="card-body">
                <h4>Present</h4>
                @foreach($securityHeaders as $hello)  


                @if($hello->type)
                <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;"><span style="color:lime">{{ $hello->data }}</span></pre></li>
                @endif
                @endforeach 
                <h4>Missing</h4>
                @foreach($securityHeaders as $hello)  
                @if(!$hello->type)
                <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;"><span style="color:#cd8000;">{{ $hello->data }}</span></pre></li>
                @endif
                @endforeach 
            </div>
        </div>
        @endif

        @if(count($handshakesimulation)>0)
        <div class="card card-default" style="margin-bottom: 10px;">
            <div class="card-header"><H4>Handshake Simulation</H4></div>
            <div class="card-body">
                @foreach($handshakesimulation as $hello)  
                <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;">{!! $hello->data !!}</pre></li>
                @endforeach 
            </div>
        </div>
        @endif

        @if(count($securitybreaches)>0)
        <div class="card card-default" style="margin-bottom: 10px;">
            <div class="card-header"><H4>Security breaches</H4></div>
            <div class="card-body">
                @foreach($securitybreaches as $hello)  
                <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;">{!! $hello->data !!}</pre></li>
                @endforeach 
            </div>
        </div>
        @endif
        @if(count($offeredprotocols)>0)
        <div class="card card-default" style="margin-bottom: 10px;">
            <div class="card-header"><H4>Offered protocols</H4></div>
            <div class="card-body">
                @foreach($offeredprotocols as $hello)  
                <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;">{!! $hello->data !!}</pre></li>
                @endforeach 
            </div>
        </div>
        @endif

        @if(count($serverhello)>0)
        <div class="card card-default" style="margin-bottom: 10px;">
            <div class="card-header"><H4>Server Hello</H4></div>
            <div class="card-body">
                @foreach($serverhello as $hello)  
                <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;">{!! $hello->data !!}</pre></li>
                @endforeach 
            </div>
        </div>
        @endif

        @if(count($ciphersperprotocol)>0)
        <div class="card card-default" style="margin-bottom: 10px;">
            <div class="card-header"><H4>Ciphers per protocol</H4></div>
            <div class="card-body">
                @foreach($ciphersperprotocol as $hello)  
                <li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><pre style="margin: 0;">{!! $hello->data !!}</pre></li>
                @endforeach 
            </div>
        </div>
        @endif
    </div>
    <div class="card-footer ">
        <a type="button" class="btn btn-success" href="/admin/tests">Back</a>
    </div>
    
    </div>
@endsection
