<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;


class AdminController extends Controller
{
    public function index(){

        $rentals = Rental::where('date_end', '>', date('Y-m-d'))->orderBy('date_start')->paginate(5);
        $cars = Car::all();
        return view('admin.index', compact('rentals', 'cars'));
    }
}
