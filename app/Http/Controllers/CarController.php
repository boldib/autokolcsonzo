<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Repositories\Car\CarRepositoryInterface;

class CarController extends Controller
{

    private CarRepositoryInterface $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index()
    {
        $cars = Car::where('status', 1)->paginate(5);
        return view('welcome', compact('cars'));
    }

    public function show($id, $slug)
    {
        $car = $this->carRepository->findCar($id, $slug);
        $days = $this->carRepository->daysCount();
        return view('car.show', compact('car', 'days'));
    }

    public function create()
    {
        return view('car.create');
    }

    public function store(Request $request)
    {
        $car = $this->carRepository->store($request);
        return redirect("/");
    }

    public function edit($id, $slug)
    {
        $car = $this->carRepository->findCar($id, $slug);
        return view('car.edit', compact('car'));
    }

    public function update(Request $request, $id, $slug)
    {
        $car = $this->carRepository->findCar($id, $slug);
        $car = $this->carRepository->update($request, $car);
        return redirect(route('admin.index'));
    }

    public function delete($id, $slug)
    {
        $car = $this->carRepository->findCar($id, $slug);
        $car->rental()->delete();
        $car->delete();
        return redirect()->back();
    }

    public function datefinder(Request $request)
    {
        $cars = $this->carRepository->dateFinder($request);
        $days = $this->carRepository->daysCount();
        return view('car.find', compact('cars', 'days'));
    }
}
