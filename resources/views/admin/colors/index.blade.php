@extends('layouts.app')
@section ('content')
<h1>Colors</h1>




<div class="card card-default">
    <div class="card-header"><H3>Color management</H3></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Color</th>
            <th> </th>
        </tr>
    </thead>
    
    <tbody>
        @if (count($colors) > 0)
            @foreach ($colors as $color)
                <tr data-entry-id="{{ $color->id }}">
                    <td field-key='name'>{{ $color->name }}</td>
                    <td field-key='color' style="color:{{ $color->color }}">{{ $color->color }}</td>
                    <td>
                        <a href="{{ route('admin.colors.edit',[$color->id]) }}" class="btn btn-xs btn-info">Edit</a>
                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('Are you sure?');",
                            'route' => ['admin.colors.destroy', $color->id])) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">No entries in table</td>
            </tr>
        @endif
    </tbody>
</table>
<div class="card-footer ">
</div>

</div>
</tbody>
</table>
@endsection
