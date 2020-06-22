@extends('layouts.app')

@section ('content')
    <div class="card card-default">
    <div class="card-header"><H3>Login history</H3></div>
    <div class="card-body">
    @if(count($ips)>0)
        @foreach($ips as $ip)  
        <div class="card card-default w-50" style="margin-bottom: 10px;">
            <div class="card-header"><H4>{{$ip->ip}}</H4></div>
            <div class="card-body">
                <div><small>fingerPrint: <b>{{$ip->fingerprint}} </b></small></div>
                <div><small>created at: <b>{{$ip->created_at}} </b></small></div>
            </div>
        </div>
        @endforeach
        {{$ips->links()}}
    @else
        <p>No history found</p>
    @endif
    </div>
    
    </div>
@endsection
