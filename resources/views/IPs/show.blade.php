@extends('layouts.app')

@section ('content')
    <a href="/IPs" class="btn btn-default">Back</a>
    <h1>Post</h1>

    <div class ="well">
    <h3><a href="/IPs/{{$ip->id}}">{{$ip->ip}}</a></h3>
    <small>frequency {{$ip->frequency}}</small>
    <hr>
     <a href="/IPs/{{$ip->id}}/edit" type="button" class="btn btn-primary">Edit</a>

     {!!Form::open(['action' => ['IPsController@destroy', $ip->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
     {!!Form::close()!!}
@endsection
