@extends('layouts.app')
@section ('content')
<div class="card card-default">
    <div class="card-header">
        <h3>Create IP test</h3>
    </div>
    <form action="{{route('IPs.store')}}" method="POST">
        @csrf
        {{method_field('POST')}}
        <div class="card-body">
            <div class="container form-group">
                <div class="row form-group container">
                    <label for="frequency" class="col-form-label col-lg-2 text-md-left">Frequency</label>
                    <select id="frequency" class="col-md-4" name="frequency">
                        <option selected="selected" value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="one time">One time</option>
                    </select>
                </div>
                <div class="row form-group container">
                    <label for="time" class="col-form-label col-lg-2 text-md-left">Time</label>
                    <input type="time" class="col-md-4" id="time" name="time" value={{\Carbon\Carbon::now()->Format('H:i')}} required>
                </div>
                <div class="row form-group container">
                    <label for="when" class="col-form-label col-lg-2 text-md-left">When to start</label>
                    <input type="date" class="col-md-4" id="when" name="when" value={{\Carbon\Carbon::now()}} required>
                </div>
                <div class="row form-group container">
                    <label for="ip" class="col-form-label col-lg-2 text-md-left">IP</label>
                    <input type="text" class="col-md-4" id="ip" name="ip" value='127.0.0.1' required>
                </div>
                <div class="row form-group container">
                    <label for="email" class="col-form-label col-lg-2 text-md-left">Email to</label>
                    <input type="email" class="col-md-4" id="email" name="email" value={{auth()->user()->email}} required>
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a type="button" class="btn btn-secondary" href="/IPs">Cancel</a>
        </div>
    </form>
</div>
@endsection