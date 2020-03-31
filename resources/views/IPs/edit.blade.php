@extends('layouts.app')

@section ('content')
    <h3>Edit Post</h3>
   {!! Form::open(['action' => ['IPsController@update', $ip->id], 'method' => 'POST']) !!}
        <div class="form-group">
            <div>
                {{Form::label('frequency', 'Frequency')}}
                {{Form::select('frequency', ['daily' => 'Daily','weekly' => 'Weekly'], $ip->frequency)}}
             </div>
             <div>
                {{Form::label('time', 'Time')}}
                {{Form::time('when',\Carbon\Carbon::parse($ip->when) )}}
            </div>
            <div>
                {{Form::label('when', 'When to start')}}
                {{Form::date('when',\Carbon\Carbon::parse($ip->when) )}}
            </div>
             <div>
                {{Form::label('ip', 'IP')}}
                {{Form::text('ip', $ip->ip)}}
            </div>
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
