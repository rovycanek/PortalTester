@extends('layouts.app')
@section('content')
      <h1 align="center">{{$title}}</h1>
      @guest
      @else
      {!! Form::open(['action' => 'TestsController@store', 'method' => 'POST']) !!}
        <div class="input-group mb-3">
          {{Form::text('IP', '127.0.0.1',['class' => 'form-control'])}}
          <div class="input-group-append">
          {{Form::submit('Test',['class' => 'btn btn-outline-secondary'])}}
          </div>
        </div>
       {!! Form::close() !!}

       @if(count($headers)>0)
       <div class="no-gutters border rounded overflow-hidden flex-md-row shadow-sm position-relative  p-2 row">
       <ul>
        @foreach($headers as  $head=> $head_value)
          <li>{{$head}}</li>
          <ul>
           @foreach($head_value as $he=> $x_value)
            @if(strlen($he)>3)
            <li>{{$he}}: {{$x_value}}</li>

            @endif
            @if(strlen($he)<=3)
            <li>{{$x_value}}</li>
            @endif
            @endforeach
          </ul>
        @endforeach
        </ul>
        </div>
       @endif


      @endguest
@endsection
