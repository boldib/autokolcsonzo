<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Models\Rental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource;
use App\Http\Resources\RentalResource;

class ApiController extends Controller
{
    public function index(){
        return CarResource::collection(Car::all());
    }

    public function getByDate($date_start, $date_end){

        $rentals = Rental::whereBetween('date_start', [$date_start, $date_end])
            ->orwhereBetween('date_end', [$date_start, $date_end])
            ->get();
        $rentedCarIds = $rentals->pluck('car_id')->unique();

        return CarResource::collection(Car::whereNotIn('id', $rentedCarIds)->where('status', 1)->get());
    }

}
