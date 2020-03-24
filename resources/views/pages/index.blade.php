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
       @include('tests.tests')
      @endguest
@endsection
