@extends('layouts.app')

@section ('content')
    <div class="card card-default">
    <div class="card-header"><H3>IPs</H3></div>
    
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
                            
                                <a href="/admin/IPs/{{$ip->id}}/edit" type="button" class="btn btn-primary float-left btn-sm">Edit</a>
                                {!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('Are you sure?');",
                                    'route' => ['admin.IPs.destroy', $ip->id])) !!}
                                {!! Form::submit('Delete', array('class' => 'btn float-left btn-sm btn-danger')) !!}
                                {!! Form::close() !!}
              
                        
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" align="center">No entries in table</td>
                </tr>
            @endif
        </div>
        </tbody>
    </table>





















    <div class="card-footer ">

    </div>
    
    </div>
@endsection
