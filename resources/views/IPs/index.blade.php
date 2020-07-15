@extends('layouts.app')

@section ('content')
<div class="card card-default">
    <div class="card-header">
        <H3>IPs</H3>
    </div>
    <div class="card-body">
        @if(count($ips)>0)
        @foreach($ips as $ip)
        <div class="card card-default w-50" style="margin-bottom: 10px;">
            <div class="card-header">
                <H4>{{$ip->ip}}</H4>
            </div>
            <div class="card-body">
                <div><small>Frequency: <b>{{$ip->frequency}} </b></small></div>
                <div><small>Next start at: <b>{{$ip->when}} </b></small></div>
                <div><small>Send email to: <b>{{$ip->email}} </b></small></div>
            </div>
            <div class="card-footer d-flex justify-content-end flex-row">
                <a type="button" href="/IPs/{{$ip->id}}/edit" class="btn btn-primary btn-xs mr-1">Edit</a>
                <form action="{{route('IPs.destroy', $ip->id)}}" method="POST" class="pull-right">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('Are you sure?')"
                      class="btn btn-xs btn-danger">Delete</button>
                </form>
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
        <a type="button" class="btn btn-success float-left mr-2" href="/IPs/create">Create IP</a>
        {{$ips->links()}}
    </div>
</div>
@endsection