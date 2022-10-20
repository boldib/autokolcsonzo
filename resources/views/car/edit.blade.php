@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-2 mt-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col pt-1"><strong>Edit:</strong> {{$car->name}}</div>
                        <div class="col"><span class="text-right">
                                <form action="{{route('admin.car-delete', ['id' => $car->id, 'slug' => $car->slug])}}" method="post"> @csrf @method ('DELETE')<button class="btn btn-sm bg-danger text-light mr-2" type="submit" name="action" value="delete" />Delete</button></form>
                            </span></div>
                    </div>
                </div>


                <div class="card-body">
                    <form class="p-4" method="POST" action="{{route('admin.car-update', ['id' => $car->id, 'slug' => $car->slug])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label"><strong>Car Name:</strong><span class="required"></span></label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $car->name }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label"><strong>Daily Price:</strong></label>

                            <input id="price" type="text" pattern="^[^,]+(?:,[^,]+){0,4}$" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $car->price }}" autocomplete="price" autofocus>

                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="form-group row pt-2">
                            <div class="col custom-file">
                                <label class="custom-file-label" for="image"><span>Upload Image File</span></label>
                                <input class="custom-file-input" type="file" id="image" name="image">

                                @error('image')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="form-group pt-2">
                            <div class="row">
                                <div class="col-1 p-2 ">
                                    <label for="status"><strong>Status:</strong></label>
                                </div>

                                <div class="col-3">
                                    <select class="custom-select custom-select" name="status" id="status" required>
                                        <option value="1" @if($car->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($car->status == 0) selected @endif>Inactive</option>
                                    </select>
                                </div>

                            </div>
                        </div>


                        <div class="submit-button mt-3 text-right">
                            <button class="button btn-sm btn-primary">Save</button>
                        </div>

                    </form>
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
                        <div class="col-3 mt-4"><strong>Status:</strong></div>
                        <div class="col-9 mt-4">@if($car->status == 0) <span class="text-danger">Inactive</span> @else <span class="text-success">Active</span> @endif</div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection