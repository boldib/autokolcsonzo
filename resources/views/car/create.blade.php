@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col mt-2">
            <div class="card">
                <div class="card-header">Create new Car item</div>

                <div class="card-body">
                    <form class="p-4" method="POST" action="{{ route('admin.car-store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label"><strong>Car Name:</strong><span class="required"></span></label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label"><strong>Daily Price:</strong></label>
                            <input id="price" type="text" pattern="^[^,]+(?:,[^,]+){0,4}$" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" autocomplete="price" autofocus>
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
                                <input class="custom-file-input" type="file" id="image" name="image" required>

                                @error('image')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group pt-2">
                            <div class="row">
                                <!-- Status -->
                                <div class="col-1 p-2 ">
                                    <label for="status"><strong>Status:</strong></label>
                                </div>

                                <div class="col-3">
                                    <select class="custom-select custom-select" name="status" id="status">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                            </div>
                        </div>


                        <div class="submit-button mt-3 text-right">
                            <button class="button btn-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection