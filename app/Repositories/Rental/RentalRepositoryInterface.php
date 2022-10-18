<?php

namespace App\Repositories\Rental;
use Illuminate\Http\Request;

interface RentalRepositoryInterface
{
    public function validateRequest(Request $request);
    public function store(Request $request, $id);
    public function delete($id);
}