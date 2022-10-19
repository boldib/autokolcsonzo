<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Rental\RentalRepositoryInterface;

class RentalController extends Controller
{
    private RentalRepositoryInterface $rentalRepository;

    public function __construct(RentalRepositoryInterface $rentalRepository)
    {
        $this->rentalRepository = $rentalRepository;
    }

    public function store(Request $request, $id)
    {
        $rental = $this->rentalRepository->store($request, $id);
        return redirect()->back();
    }

    public function delete($id)
    {
        $this->rentalRepository->delete($id);
        return redirect()->back();
    }
}
