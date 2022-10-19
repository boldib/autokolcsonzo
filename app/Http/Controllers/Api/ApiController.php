<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Models\Rental;

use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource;

class ApiController extends Controller
{
    public function index()
    {
        return CarResource::collection(Car::all());
    }

    public function getByDate($date_start, $date_end)
    {

        $rentals = Rental::whereBetween('date_start', [$date_start, $date_end])
            ->orwhereBetween('date_end', [$date_start, $date_end])
            ->get();
        $rentedCarIds = $rentals->pluck('car_id')->unique();

        return CarResource::collection(Car::whereNotIn('id', $rentedCarIds)->where('status', 1)->get());
    }

    public function storeRental(Request $request)
    {

        $data = request()->validate([
            'car_id' => 'required',
            'name' => 'required',
            'email' => ['string', 'email', 'max:255'],
            'address' => 'required',
            'phone' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        $car = Car::find($data['car_id']);

        $date1 = new DateTime($data['date_start']);
        $date2 = new DateTime($data['date_end']);
        $days  = $date2->diff($date1)->format('%a');
        $price = $days * $car->price;

        $rental = Rental::create([
            'car_id' => $car->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'date_start' => $data['date_start'],
            'date_end' => $data['date_end'],
            'price' => $price,
        ]);

        return response()->json(['created' => true]);
    }
}
