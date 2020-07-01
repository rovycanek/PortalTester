@extends('layouts.app')
@section('content')
      <h1>Users</h1>
      
              

              <div class="card card-default">
                <div class="card-header"><H3>User management</H3></div>

   
                  <table class="table table-hover">
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
                              @can('edit-users')
                               <a href="{{route('admin.users.edit',$user->id )}}"> <button type="button" class="float-left btn btn-primary">Edit</button></a>
                              @endcan
                              @can('delete-users')
                               <form action="{{route('admin.users.destroy',$user->id)}}" method="POST" class="float-left">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-secondary">Delete</button>
                              </form>
                              @endcan
                          </td>
                        </tr>
                          
                      @endforeach
                    {{$users->links()}}
                   </table>
      
                <div class="card-footer ">
                </div>
                
                </div>



























     

            </tbody>
          </table>

@endsection
