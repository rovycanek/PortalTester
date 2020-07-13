@extends('layouts.app')

@section ('content')
    <div class="card card-default">
        <div class="card-header"><H3>test SSL manager</H3></div>
        <div class="card-body">
            <a href="/admin/testSsl/create" onclick="return confirm('Are you sure?')" type="button" class="btn btn-primary btn-sm">Aktualize Git repo</a>
        </div> 
        <div class="card-footer d-flex justify-content-end flex-row"> </div>   
    </div>
@endsection