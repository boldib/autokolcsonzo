<?php

namespace Tests\Unit;
use App\Models\Car;
use App\Models\Rental;

use Illuminate\Support\Facades\Event;

use Tests\TestCase;

class RentalTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_store_rental_service()
    {
        $car = Car::all()->random(1)->first();
        $rental = Rental::factory()->make();

        $response = $this->json('POST', route('rental.store', ['id' => $rental->car_id]), [
            'car_id' => $car->id,
            'name' => $rental->name,
            'email' => $rental->email,
            'address' => $rental->address,
            'phone' => $rental->phone,
            'date' => "$rental->date_start to $rental->date_end",
            'price' => $car->price,
        ]);
    
        $response->assertRedirect();
        
    }
}
