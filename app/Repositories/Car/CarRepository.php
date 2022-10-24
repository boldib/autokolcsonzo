<?php

namespace App\Repositories\Car;

use App\Models\Car;
use App\Models\Rental;

use Auth;
use DateTime;
use App\Classes\Imgstore;
use Illuminate\Support\Str;

class CarRepository implements CarRepositoryInterface
{
    public function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|gt:0',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
        ]);
    }

    public function store($request)
    {
        $data = $this->validateRequest($request);

        $car = Car::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'slug' => Str::of($data['name'])->slug(),
            'image' => Imgstore::setCarImage($request->file('image')),
            'status' => $data['status'],
            'price' => $data['price'],
        ]);
        return $car->slug;
    }

    public function update($request, $car)
    {
        $data = $this->validateRequest($request);

        if ($request->file('image')) {
            Imgstore::delete($car->image);
            $image = Imgstore::setCarImage($request->file('image'));
        } else {
            $image = $car->image;
        }

        $car->update([
            'name' => $data['name'],
            'slug' => Str::of($data['name'])->slug(),
            'image' => $image,
            'status' => $data['status'],
            'price' => $data['price'],
        ]);

        if ($data['status'] == 0) {
            $rentals = Rental::where('car_id', $car->id)->delete();
        }

        return $car->slug;
    }

    public function daysCount()
    {
        if (isset($_GET['date'])) {
            $dates = explode(' to ', $_GET['date']);

            if (isset($dates[1])) {
                $start = $dates[0];
                $end = $dates[1];
            } else {
                $start = $dates[0];
                $end = $start;
            }
        } else {
            $start = null;
            $end = null;
        }
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $days  = $date2->diff($date1)->format('%a');

        if ($days > 0) return $days;
    }

    public function dateFinder($request)
    {
        $date = explode(" to ", $request->date);
        $dateStart = $date[0];
        if (isset($date[1])) {
            $dateEnd = $date[1];
        } else {
            $dateEnd = $date[0];
        }

        $rentals = Rental::whereBetween('date_start', [$dateStart, $dateEnd])
            ->orwhereBetween('date_end', [$dateStart, $dateEnd])
            ->get();

        $rentedCarIds = $rentals->pluck('car_id')->unique();
        $cars = Car::whereNotIn('id', $rentedCarIds)->where('status', 1)->paginate(5);

        return $cars;
    }

    public function findCar($id, $slug)
    {
        $car = Car::where('id', $id)->where('slug', $slug)->firstOrFail();
        return $car;
    }

    public function findBySlug($slug)
    {
        $car = Car::where('slug', $slug)->firstOrFail();
        return $car;
    }
}
