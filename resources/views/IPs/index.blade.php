@extends('layouts.app')

@section ('content')
    <h3>IPs</h3>
    @if(count($ips)>0)
        @foreach($ips as $ip)  
            <div class=" no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative w-50 p-2 row">
                <div class="">
                <h3>{{$ip->ip}}</h3>
                <small>Frequency: <b>{{$ip->frequency}} </b></small>
                <small>Day: <b>{{$ip->day}} </b></small>
                <small>Time: <b>{{$ip->time}} </b></small>
                <small>Created at: <b>{{$ip->created_at}} </b></small>
                </div>
                <div class="text-right ml-auto">
                <a href="/IPs/{{$ip->id}}/edit" type="button" class="btn btn-primary btn-sm btn-block">Edit</a>
                 {!!Form::open(['action' => ['IPsController@destroy', $ip->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-block'])}}
                 {!!Form::close()!!}
                </div>
            </div>
        @endforeach
        {{$ips->links()}}
    @else
        <p>No IPs found</p>
    @endif
    <a type="button" class="btn btn-success" href="/IPs/create">Create IP</a>
@endsection
