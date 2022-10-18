@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">Available cars on the selected date range:</div>
                <div class="card-body">
                    <x-carlist :cars="$cars"></x-menu>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-header mb-2">Find available cars by date:</div>
                <div class="m-auto">
                    <x-datepicker></x-datepicker>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection