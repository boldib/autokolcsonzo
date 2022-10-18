<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Rental;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = Carbon::createFromTimeStamp($this->faker->dateTimeBetween('+10 days', '+40 days')->getTimestamp());
        $daysBetween = rand(2, 30);
        $date_start = date('Y-m-d', strtotime($date));
        $date_end = date('Y-m-d', strtotime($date->addDays($daysBetween)));

        $rentals = Rental::whereBetween('date_start', [$date_start, $date_end])
            ->orwhereBetween('date_end', [$date_start, $date_end])
            ->get();

        $rentedCarIds = $rentals->pluck('car_id')->unique();
        $cars = Car::whereNotIn('id', $rentedCarIds)->where('status', 1)->get();
        $car = $cars->first();

        $price = $daysBetween * $car->price;
        
        return [
            'car_id' => $car->id,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'date_start' => $date_start,
            'date_end' => $date_end,
            'price' => $price,
        ];
    }
}
