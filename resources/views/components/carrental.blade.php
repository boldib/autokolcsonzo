<div class="message m-2">
    {!! Session::has('msg') ? Session::get("msg") : '' !!}
    <x-errors :errors="$errors"></x-errors>
</div>

<div class="rental-form" @if(Session::has('msg')) style="display:none;" @endif>

    <h5 class="pb-3">Rental form:</h5>

    <form id="rental" method="POST" action="{{route('rental.store', ['id' => $car->id])}}">
        @csrf

        <!-- Name -->
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label"><span>Name: </span></label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <!-- Email -->
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label"><span>E-Mail: </span></label>

            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <!-- Address -->
        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label"><span>Address: </span></label>

            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <!-- Phone -->
        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label"><span>Phone: </span></label>

            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>

        <div>
            <div class="text-center m-auto">
                <div class="m-4">

                    @if(!request()->get('date'))
                    <p class="text-center">Choose an available date:</p>
                    @endif

                    <input style="display:none;" type="datetime-local" id="date{{$car->id}}" name="date" class="date{{$car->id}}" style="width:300px; border: 0px" />

                    @error('date')
                    <div class="mt-2">
                        <span class="invalid-feedback mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    </div>
                    @enderror

                    <div class="submit-button mt-3">
                        <p class="text-center">
                            <button onclick="action{{$car->id}}();" class="button btn-primary p-2">Send</button>
                        </p>
                    </div>
                </div>
                </p>

                <div class="pl-2 mr-4 col-sm"></div>
            </div>
        </div>
    </form>
</div>

{{Calendar::calendarJS($car)}}