@extends('layouts.app')

@section ('content')
    <h3>Create Post</h3>
   {!! Form::open(['action' => 'IPsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            <div>
                {{Form::label('frequency', 'Frequency')}}
                {{Form::select('frequency', ['daily' => 'Daily','weekly' => 'Weekly','one time' => 'One time'], 'daily')}}
             </div>
             <div>
                {{Form::label('time', 'Time')}}
                {{Form::time('time', \Carbon\Carbon::now())}}
            </div>
            <div>
                {{Form::label('when', 'When to start')}}
                {{Form::date('when',\Carbon\Carbon::now())}}
            </div>
             <div>
                {{Form::label('ip', 'IP')}}
                {{Form::text('ip', '127.0.0.1')}}
            </div>
        </div>
        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
