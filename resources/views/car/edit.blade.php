@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8 mt-2">
            <div class="card">
                <div class="card-header"><strong>Edit:</strong> {{$car->name}}</div>

                <div class="card-body">
                    <form class="p-4" method="POST" action="{{route('admin.update', ['id' => $car->id, 'slug' => $car->slug])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label"><span>Car Name:</span> <span class="required"></span></label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $car->name }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label"><span>Daily Price:</span></label>

                            <input id="price" type="text" pattern="^[^,]+(?:,[^,]+){0,4}$" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $car->price }}" autocomplete="price" autofocus>

                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <!-- Image -->
                                <label for="image"><span>Image:</span></label>
                                <input type="file" class="form-control-file mb-4" id="image" name="image">

                                @error('image')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col text-right">
                                <!-- Status -->
                                <label for="status" style="padding-top: 8px;padding-right: 10px;">Status:</label>

                                <select name="status" id="status" required>
                                    <option value="1" @if($car->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($car->status == 0) selected @endif>Inactive</option>
                                </select>
                            </div>
                        </div>


                        <div class="submit-button mt-3 text-right">
                            <button class="button btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-4">
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