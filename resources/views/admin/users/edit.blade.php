@extends('layouts.app')
@section('content')

<div class="card card-default">
  <div class="card-header">
    <h3>Edit user {{$user->name}}</h3>
  </div>
  <form action="{{route('admin.users.update',$user)}}" method="POST">
    @csrf
    {{method_field('PUT')}}
    <div class="card-body ">
      <div class="container form-group">
        <div class="row form-group container">
          <label for="name" class="col-form-label col-lg-2 text-md-left">Name</label>


          <input id="name" type="text" class="form-control col-md-4 @error('name') is-invalid @enderror" name="name"
            value="{{ $user->name}}" required>

          @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>

        <div class="row form-group container">
          <label for="email" class="col-form-label col-lg-2 text-md-left">Email</label>


          <input id="email" type="email" class="form-control col-md-4 @error('email') is-invalid @enderror" name="email"
            value="{{ $user->email}}" required autocomplete="email">

          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>

        <div class="row form-group container">
          <label for="roles" class="col-form-label col-lg-2 text-md-left">Roles</label>


          @foreach ($roles as $role)
          <div class="float-left pr-3" >
            <input class="align-middle" type="checkbox" name="roles[]" value="{{$role->id}}"
              @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
            <label class="col-form-label text-md-right">{{$role->name}}</label>
          </div>
          @endforeach

        </div>

      </div>
    </div>
    <div class="card-footer ">
      <button type="submit" class="btn btn-primary">Submit</button>
      <a type="button" class="btn btn-secondary" href="/admin/users">Cancel</a>

    </div>
  </form>
</div>
@endsection