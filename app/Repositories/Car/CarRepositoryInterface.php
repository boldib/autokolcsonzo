<?php

namespace App\Repositories\Car;
use Illuminate\Http\Request;

interface CarRepositoryInterface
{
    public function validateRequest(Request $request);
    public function store(Request $request);
    public function update(Request $request, Car $car);
    public function datefinder(Request $request);
    public function findCar($id, $slug);
    public function findBySlug($slug);

}