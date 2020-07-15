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
                    <select id="frequency" name="frequency">
                        <option selected="selected" value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="one time">One time</option>
                    </select>
                </div>
                <div class="row form-group container">
                    <label for="time" class="col-form-label col-lg-2 text-md-left">Time</label>
                    <input type="time" id="time" name="time" value={{\Carbon\Carbon::now()->Format('H:i')}}>
                </div>
                <div class="row form-group container">
                    <label for="when" class="col-form-label col-lg-2 text-md-left">When to start</label>
                    <input type="date" id="when" name="when" value={{\Carbon\Carbon::now()}}>
                </div>
                <div class="row form-group container">
                    <label for="ip" class="col-form-label col-lg-2 text-md-left">IP</label>
                    <input type="text" id="ip" name="ip" value='127.0.0.1'>
                </div>
                <div class="row form-group container">
                    <label for="email" class="col-form-label col-lg-2 text-md-left">Email to</label>
                    <input type="email" id="email" name="email" value={{auth()->user()->email}}>
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