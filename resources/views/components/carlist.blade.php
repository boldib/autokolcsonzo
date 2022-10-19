<div>
    @if(count($cars) == 0) no available cars @endif
    @foreach($cars as $car)
    <div class="row m-2 border">
        <div class="col-4 p-2">
            <a href="{{ route('cars.show', ['id' => $car->id, 'slug' => $car->slug]) }}@if(request()->get('date'))?date={{ request()->get('date') }}@endif"><img style="width:100%;" src="{{$car->image()}}"></a>
        </div>
        <div class="col p-2">
            <p><strong><a class="text-dark" href="{{ route('cars.show', ['id' => $car->id, 'slug' => $car->slug]) }}@if(request()->get('date'))?date={{ request()->get('date') }}@endif">{{$car->name}}</a></strong><br>
                @if(isset($days)) Full price: {{$car->price * $days}} Ft @else Daily price: {{$car->price}} Ft @endif
            </p>
            <p><strong><a class="btn btn-success" href="{{ route('cars.show', ['id' => $car->id, 'slug' => $car->slug]) }}@if(request()->get('date'))?date={{ request()->get('date') }}@endif">Rent this car</a></strong><br>
        </div>
    </div>
    @endforeach

    <div class="col d-flex justify-content-center mt-4">
        <div class="row">{{ $cars->withQueryString()->links('pagination::bootstrap-4') }}</div>
    </div>
</div>