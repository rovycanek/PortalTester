@extends('layouts.app')

@section ('content')
    <div class="card card-default">
    <div class="card-header"><H3>Login history</H3></div>

    <table class="table table-hover">
        <thead>
            <tr>  
                <th scope="col">Scaned site</th>
                <th scope="col">Type of test</th>
                <th scope="col">When test was started</th>
                <th scope="col">Details</th>
              </tr>
        </thead>
        <tbody>
            @if(count($tests)>0)
                @foreach($tests as $test)  
                <tr>
                    <td>{{$test->subject}}</td>
                    <td>{{$test->type}}</td>
                    <td>{{$test->created_at->format('Y.m.d H:i:s')}}</td>
                    <td><a href="/tests/{{$test->id}}" type="button" class="btn btn-primary btn-sm">Show details</a></td>

                </tr>
                @endforeach
                
            @else
            @endif
        </tbody>
        {{$tests->links()}}
    </table>    
    </div>
@endsection
