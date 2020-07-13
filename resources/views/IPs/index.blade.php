@extends('layouts.app')

@section ('content')
    <div class="card card-default">
        <div class="card-header"><H3>IPs</H3></div>
        <div class="card-body">
        @if(count($ips)>0)
            @foreach($ips as $ip)  
                <div class="card card-default w-50" style="margin-bottom: 10px;">
                    <div class="card-header"><H4>{{$ip->ip}}</H4></div>
                    <div class="card-body">
                        <div><small>Frequency: <b>{{$ip->frequency}} </b></small></div>
                        <div><small>Next start at: <b>{{$ip->when}} </b></small></div>
                        <div><small>Send email to: <b>{{$ip->email}} </b></small></div>
                    </div>
                    <div class="card-footer d-flex justify-content-end flex-row">
                        <a href="/IPs/{{$ip->id}}/edit" type="button" class="btn btn-primary btn-sm">Edit</a>
                        
                        {!!Form::open(['action' => ['IPsController@destroy', $ip->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])}}
                        {!!Form::close()!!}
                    </div>
                </div>
            @endforeach
    @else
    <div class="card card-default w-50" style="margin-bottom: 10px;">
        <div class="card-header"></div>
        <div class="card-body">
            <H5 align="center">No IPs found</H5>
        </div>
        <div class="card-footer d-flex justify-content-end flex-row">

        </div>
    </div>
    @endif
    </div>
    <div class="card-footer ">
        <a type="button" class="btn btn-success" href="/IPs/create">Create IP</a>
        {{$ips->links()}}
    </div>
    
    </div>
@endsection
