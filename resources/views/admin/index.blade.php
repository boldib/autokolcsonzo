@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-2">
            <div class="card">
                <div class="card-header">Rentals:</div>
                <div class="card-body">
                    @foreach($rentals as $r)
                    <div class="card bg-light p-2 m-2 border">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-8"><strong>{{$r->date_start}} - {{$r->date_end}}</strong></div>
                                <div class="col text-right">Rental ID: #{{$r->id}}</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{$r->car->name}}<br>

                                </div>
                                <div class="row text-right m-2">
                                    <form action="{{route('rental.delete', ['id' => $r->id])}}" method="post"> @csrf @method ('DELETE')<button class="btn btn-sm bg-danger text-light mr-1" type="submit" name="action" value="delete" />Delete</button></form>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#RentalModal{{$r->id}}">
                                        More Details
                                    </button>
                                </div>
                            </div>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="RentalModal{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="RentalModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="RentalModalLabel">Details of Rental #{{$r->id}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Date:</strong> {{$r->date_start}} - {{$r->date_end}}</p>
                                        <p><strong>Name:</strong> {{$r->name}}</p>
                                        <p><strong>Phone:</strong> <a href="tel:{{$r->phone}}">{{$r->phone}}</a></p>
                                        <p><strong>E-Mail:</strong> <a href="mailto:{{$r->email}}">{{$r->email}}</a></p>
                                        <p><strong>Address:</strong> {{$r->address}}</p>
                                        <p><strong>Vehicle:</strong> <a href="{{ route('cars.show', ['id' => $r->car->id, 'slug' => $r->car->slug]) }}">{{$r->car->name}}</a></p>
                                        <p><strong>Price:</strong> {{$r->price}} Ft</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach
                    <div class="col d-flex justify-content-center mt-4">
                        <div class="row">{{ $rentals->links('pagination::bootstrap-4') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header mb-2">
                    <div class="row">
                        <div class="col">Manage cars:</div>
                        <div class="col text-right">
                            <a class="text-light bg-primary p-2" href="{{ route('admin.car-create')}}">Add new car</a>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    @foreach($cars->sortBy('name') as $car)
                    <div class="row">
                        <div class="col p-2">{{$car->name}} @if($car->status == 0) <span class="text-danger">(Inactive)</span> @endif</div>
                        <div class="col-4 p-2">
                            <div class="row">
                            <span><form action="{{route('admin.car-delete', ['id' => $car->id, 'slug' => $car->slug])}}" method="post"> @csrf @method ('DELETE')<button class="btn btn-sm bg-danger text-light mr-1" type="submit" name="action" value="delete" />Delete</button></form></span>
                                <span class="mr-1"><a class="btn btn-sm btn-primary" href="{{route('admin.car-edit', ['id' => $car->id, 'slug' => $car->slug])}}">Edit</a></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

@endsection