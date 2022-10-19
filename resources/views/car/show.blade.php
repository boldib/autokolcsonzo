@inject('Calendar', 'App\Classes\Calendar')

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-2">
            <div class="card">
                <div class="card-header">{{$car->name}}</div>
                <div class="card-body">
                    <div class="p-2">
                        <x-carrental :car="$car">
                            </x-menu>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">{{$car->name}}</div>
                <div class="card-body">
                    <img style="width:100%;" src="{{$car->image()}}"></a>
                    <div class="row mt-4">
                        <div class="col-3"><strong>Name:</strong></div>
                        <div class="col-9">{{$car->name}}</div>
                        <div class="col-3"><strong>Price:</strong></div>
                        <div class="col-9">{{$car->price}} Ft (daily)</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection