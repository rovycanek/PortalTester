@extends('layouts.app')
@section('content')
<div class="card card-default">
  <div class="card-header">
    <h3>Edit color {{$color->name}}</h3>
  </div>
  <form action="{{route('admin.colors.update',$color)}}" method="POST">
    @csrf
    {{method_field('PUT')}}
    <div class="card-body ">
      <div class="form-group row container">
        <label for="name" class="col-form-label text-md-right">{{$color->name}}</label>

        <div class="col-md-6">
          <input id="color" type="color" class="form-control " name="color" value="{{ $color->color}}" required>
        </div>
      </div>
    </div>
    <div class="card-footer ">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a type="button" class="btn btn-secondary" href="/admin/colors">Cancel</a>
    </div>
  </form>
</div>
@endsection