<?php

namespace Tests\Unit;
use App\Models\Car;
use Carbon\Carbon;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_api_store_rental()
    {
        $car = Car::factory()->create();

        $response = $this->json('POST', '/api/store/rental', [
            'car_id' => $car->id,
            'name' => 'API Test Name',
            'email' => 'test@test.com',
            'address' => 'Address 3244',
            'phone' => '+36201234567',
            'date_start' => "2022-11-01",
            'date_end' => "2022-11-12",
        ]);
    
        $response->assertJsonStructure();
    }
}
