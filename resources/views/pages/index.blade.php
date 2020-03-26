@extends('layouts.app')
@section('content')
      <h1 align="center">{{$title}}</h1>
      @guest
      @else
      {!! Form::open(['action' => 'TestsController@store', 'method' => 'POST']) !!}
        <div class="input-group mb-3">
          {{Form::text('IP', '127.0.0.1',['class' => 'form-control','id'=>'tesIP'])}}
          <div class="input-group-append">
          {{Form::submit('Test',['class' => 'btn btn-outline-secondary','id'=>'testSubmit'])}}
          </div>
        </div>
       {!! Form::close() !!}
       @include('tests.tests')
      @endguest
@endsection
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script>
  jQuery(document).ready(function(){
    jQuery('#testSubmit').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      console.log(jQuery('#tesIP').val());
        jQuery.post({
          url: '/test',
          datatype: 'json',
          data: {
              name: jQuery('#tesIP').val(),
          },
          success: function(result){
              console.log('success');
              console.log(result.success);
          },
          error: function(result){
              console.log('error');
          }
          });
        });
      });
</script>

