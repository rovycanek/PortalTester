@extends('layouts.app')
@section('content')
      
      @guest
      <h1 align="center">{{$title}}</h1>
      @else
      <div id="tests">
         <securityheadders></securityheadders>
      </div >
      @endguest
      <script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
<script>
  jQuery(document).ready(function(){
    jQuery('#testSubmit').click(function(e){


        e.preventDefault();
        console.log(app);
        });
      });
</script>


@endsection


