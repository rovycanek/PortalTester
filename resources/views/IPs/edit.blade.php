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
            {{Form::label('day', 'Day')}}
            {{Form::select('day', ['Monday' => 'Monday','Tuesday' => 'Tuesday','Wednesday' => 'Wednesday','Thursday' => 'Thursday','Friday' => 'Friday','Saturday' => 'Saturday', 'Sunday' => 'Sunday'], $ip->day)}}
            </div>
             <div>
            {{Form::label('time', 'Time')}}
            {{Form::select('time', ['0:00:00' => '0:00:00','1:00:00' => '1:00:00','2:00:00' => '2:00:00','3:00:00' => '3:00:00','4:00:00' => '4:00:00','5:00:00' => '5:00:00', '6:00:00' => '6:00:00','7:00:00' => '7:00:00','8:00:00' => '8:00:00','9:00:00' => '9:00:00','10:00:00' => '10:00:00','11:00:00' => '11:00:00','12:00:00' => '12:00:00', '13:00:00' => '13:00:00','14:00:00' => '14:00:00','15:00:00' => '15:00:00','16:00:00' => '16:00:00','17:00:00' => '17:00:00','18:00:00' => '18:00:00','19:00:00' => '19:00:00', '20:00:00' => '20:00:00','21:00:00' => '21:00:00','22:00:00' => '22:00:00','23:00:00' => '23:00:00'], $ip->time)}}
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
