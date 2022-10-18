<?php

namespace Tests\Unit;

use App\Models\Rental;
use App\Models\Car;

use Illuminate\Support\Facades\Event;

use Tests\TestCase;

class RentalTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_rental_service_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_car_loads()
    {
        $car = Car::all()->random(1)->first();
        $response = $this->get("/$car->id/$car->slug");
        $response->assertStatus(200);
    }

    public function test_rental_service()
    {
        $rental = Rental::factory()->make();
        $this->assertTrue(isset($rental->date_start));
    }
}
