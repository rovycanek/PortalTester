@extends('layouts.app')

@section ('content')
    <div class="card card-default">
    <div class="card-header"><H3>test SSL manager</H3></div>
    <a href="/admin/testSsl/create" onclick="return confirm('Are you sure?')" type="button" class="btn btn-primary btn-sm">Aktualize Git repo</a>
    </div>
@endsection