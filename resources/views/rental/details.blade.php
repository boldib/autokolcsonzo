@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">Details of your order:</div>
                <div class="card-body">
                    <div class="message m-2">
                        {!! Session::has('msg') ? Session::get("msg") : '' !!}
                    </div>
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