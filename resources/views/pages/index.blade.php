@extends('layouts.app')
@section('content')
      
      @guest
      <h1 align="center">{{$title}}</h1>
      @else
      <div id="tests">
         <tests></tests>
      </div >
      @endguest
      
</script>
@endsection


