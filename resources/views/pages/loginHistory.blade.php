@extends('layouts.app')

@section ('content')
    <div class="card card-default">
    <div class="card-header"><H3>Login history</H3></div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Loggined in at</th>
                <th scope="col">Finger print</th>
                <th scope="col">IP</th>
              </tr>
        </thead>
        <tbody>
            @if(count($ips)>0)
                @foreach($ips as $ip)  
                <tr>
                    <td>{{$ip->created_at->format('Y.m.d H:i:s') }}</td>
                    <td>{{$ip->fingerprint}}</td>
                    <td>{{$ip->ip}}</td>
                </tr>
                @endforeach
                
            @else
            @endif
        </tbody>
        {{$ips->links()}}
    </table>    
    </div>
@endsection
