@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-2">
            <div class="card">
                <div class="card-header">List of our cars:</div>
                <div class="card-body">
                    <x-carlist :cars="$cars"></x-menu>
                </div>
            </div>
        </div>

        <div class="col">
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