@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col mt-2">
            <div class="card">
                <div class="card-header">Create new Car item</div>

                <div class="card-body">
                    <form class="p-4" method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label"><span>Car Name:</span> <span class="required"></span></label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label"><span>Daily Price:</span></label>

                            <input id="price" type="text" pattern="^[^,]+(?:,[^,]+){0,4}$" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" autocomplete="price" autofocus>

                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="row">
                            <div class="col">
                                <label for="image"><span>Image:</span></label>
                                <input type="file" class="form-control-file mb-4" id="image" name="image" required>

                                @error('image')
                                <strong>{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col text-right">
                                <!-- Status -->
                                <label for="status" style="padding-top: 8px;padding-right: 10px;">Status:</label>

                                <select name="status" id="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
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


    </div>
</div>

@endsection