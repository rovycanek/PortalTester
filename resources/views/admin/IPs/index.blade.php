@extends('layouts.app')

@section ('content')
<div class="card card-default">
    <div class="card-header">
        <H3>IPs</H3>
    </div>
    <table class="table table-hover mb-0 ">
        <thead>
            <tr>
                <th>Owner</th>
                <th>Frequency</th>
                <th>Next start at</th>
                <th>Email</th>
                <th>IP</th>
                <th> Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (count($ips) > 0)
            @foreach ($ips as $ip)
            <tr data-entry-id="{{ $ip->id }}">
                <td field-key='owner'>{{ $ip->user->name }}</td>
                <td field-key='frequency'>{{ $ip->frequency }}</td>
                <td field-key='when'>{{ $ip->when }}</td>
                <td field-key='email'>{{ $ip->email }}</td>
                <td field-key='ip'>{{ $ip->ip }}</td>
                <td field-key='actions'>
                    <div class=" d-flex flex-row">
                        <a type="button" href="/admin/IPs/{{$ip->id}}/edit"
                            class="btn btn-primary float-left mr-1 btn-sm">Edit</a>
                        <form action="{{route('admin.IPs.destroy', $ip->id)}}" method="POST" class="pull-right">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                class="btn btn-sm float-left btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" align="center">No entries in table</td>
            </tr>
            @endif

        </tbody>
    </table>
    <div class="card-footer ">
    </div>
</div>
@endsection