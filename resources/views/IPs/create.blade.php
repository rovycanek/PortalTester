@extends('layouts.app')
@section ('content')
    <div class="card card-default">
        <div class="card-header"><h3>Create IP test</h3></div>
        <div class="card-body">
            {!! Form::open(['action' => 'IPsController@store', 'method' => 'POST']) !!}
        <div class="container form-group">
            <div class="row">
              <div class="col-2"> {{Form::label('frequency', 'Frequency')}}</div>
              <div class="col">{{Form::select('frequency', ['daily' => 'Daily','weekly' => 'Weekly','one time' => 'One time'], 'daily')}}</div>
              <div class="col-10"></div>
              <div class="w-100"></div>
              <div class="col-2">{{Form::label('time', 'Time')}}</div>
              <div class="col">{{Form::time('time', \Carbon\Carbon::now())}}</div>
              <div class="col-10"></div>
              <div class="w-100"></div>
              <div class="col-2">{{Form::label('when', 'When to start')}}</div>
              <div class="col">{{Form::date('when',\Carbon\Carbon::now())}}</div>
              <div class="col-10"></div>
              <div class="w-100"></div>
              <div class="col-2">{{Form::label('ip', 'IP')}}</div>
              <div class="col">{{Form::text('ip', '127.0.0.1')}}</div>
              <div class="col-10"></div>
              <div class="w-100"></div>
              <div class="col-2">{{Form::label('email', 'Email to')}}</div>
              <div class="col">{{Form::text('email', auth()->user()->email)}}</div>
              <div class="col-10"></div>
              <div class="w-100"></div>
            </div>
          </div>

        </div>
        <div class="card-footer ">
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
            <a type="button" class="btn btn-secondary" href="/IPs">Cancel</a>
        </div>
    </div>   
@endsection
