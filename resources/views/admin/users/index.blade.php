@extends('layouts.app')
@section('content')
              <div class="card card-default">
                <div class="card-header"><H3>User management</H3></div>

   
                  <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                          <th scope="row">{{$user->id }}</th>
                          <td>{{$user->name }}</td>
                          <td>{{$user->email }}</td>
                          <td>{{implode(', ', $user->roles()->pluck('name')->toArray() )}}</td>
                          <td>
                            
                            @if ($user->hasRole('new user'))
                            <form action="{{route('admin.users.update',$user)}}" method="POST">
                              @csrf
                              {{method_field('PUT')}}
                              <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name}}" required >
                              <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}" required autocomplete="email" >
                              @foreach ($roles as $role)
                              <div class ="float-left pr-3">
                                <input style ="display: none" class="align-middle" type="checkbox"  name="roles[]" value="{{$role->id}}"
                                @if($role->id==2) checked @endif>
                                <label style ="display: none" class="col-form-label text-md-right">{{$role->name}}</label>
                              </div>
                              @endforeach
                              <button type="submit" class="float-left btn-xs btn btn-success">Allow access</button>
                            </form>
                            
                            @else

                            @if ($user->hasRole('admin'))

                            <form action="{{route('admin.users.update',$user)}}" method="POST">
                              @csrf
                              {{method_field('PUT')}}
                              <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name}}" required >
                              <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}" required autocomplete="email" >
                              @foreach ($roles as $role)
                              <div class ="float-left pr-3">
                                <input style ="display: none" class="align-middle" type="checkbox"  name="roles[]" value="{{$role->id}}"
                                @if($role->id==2) checked @endif>
                                <label style ="display: none" class="col-form-label text-md-right">{{$role->name}}</label>
                              </div>
                              @endforeach
                             
                              <button type="submit" class="float-left btn btn-xs btn-warning">Demote</button>
                            </form>

                            @else



                            <form action="{{route('admin.users.update',$user)}}" method="POST">
                              @csrf
                              {{method_field('PUT')}}
                              <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name}}" required >
                              <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}" required autocomplete="email" >
                              @foreach ($roles as $role)
                              <div class ="float-left pr-3">
                                <input style ="display: none" class="align-middle" type="checkbox"  name="roles[]" value="{{$role->id}}"
                                @if($role->id!=3) checked @endif>
                                <label style ="display: none" class="col-form-label text-md-right">{{$role->name}}</label>
                              </div>
                              @endforeach
                             
                              <button type="submit" class="float-left btn btn-xs btn-primary">Promote</button>
                            </form>






                            @endif
                            @endif

                              @can('edit-users')
                               <a href="{{route('admin.users.edit',$user->id )}}"> <button type="button" class="float-left btn btn-info">Edit</button></a>
                              @endcan
                              @can('delete-users')
                               <form action="{{route('admin.users.destroy',$user->id)}}" method="POST" class="float-left">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-xs btn-danger">Delete</button>
                              </form>
                              @endcan
                          
                          </td>
                        </tr>
                          
                      @endforeach
                    
                   </table>
      
                <div class="card-footer ">
                  {{$users->links()}}
                </div>
                
                </div>



























     

            </tbody>
          </table>

@endsection
