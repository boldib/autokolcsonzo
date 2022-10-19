<?php

namespace Tests\Unit;
use App\Models\Car;
use App\Models\User;

use Auth;
use Tests\TestCase;

class CarTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_car_create()
    {
        $user = User::factory()->create();
        $car = Car::factory()->make();
        $this->actingAs($user);

        $response = $this->json('POST', route('admin.car-store'), [
            'user_id' => $car->user_id,
            'name' => $car->name,
            'slug' => $car->slug,
            'status' => $car->status,
            'price' => $car->price,
        ]);
    
        $response->assertRedirect();
    }

    public function test_car_update()
    {
        $car = Car::factory()->create();
        $user = $car->user;
        $this->actingAs($user);

        $response = $this->json('PATCH', route('admin.car-update', ['id' => $car->id, 'slug' => $car->slug]), [
            'name' => $car->name.'-update',
            'slug' => $car->slug.'-update',
            'status' => $car->status,
            'price' => $car->price + 1000,
        ]);
    
        $this->assertModelExists($user);
        $response->assertRedirect();
    }
}
