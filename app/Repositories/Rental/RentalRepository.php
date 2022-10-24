<?php

namespace App\Repositories\Rental;

use DateTime;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalRepository implements RentalRepositoryInterface
{
    public function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'email' => ['string', 'email', 'max:255'],
            'address' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'price' => 'max:500',
        ]);
    }

    public function store(Request $request, $id)
    {
        $data = $this->validateRequest($request);

        $car = Car::where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        $date = explode(" to ", $data['date']);
        $dateStart = $date[0];
        if (isset($date[1])) {
            $dateEnd = $date[1];
        } else {
            $dateEnd = $date[0];
        }

        $date1 = new DateTime($dateStart);
        $date2 = new DateTime($dateEnd);
        $days  = $date2->diff($date1)->format('%a');
        $price = $days * $car->price;

        $rental = Rental::create([
            'car_id' => $car->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'price' => $price,
        ]);

        session()->flash('msg', '<div class="alert alert-success p-4 m-4"><p>Your rental has been stored.</p><p>You can take the car from <strong>8:00 at ' . $rental->date_start . ' </strong><br> and bring it back before <strong>20:00 on ' . $rental->date_end . '</strong><p>The full price of the service is: <strong>' . $price . ' Ft</strong></p></div>');
        return $rental;
    }

    public function delete($id)
    {
        Rental::find($id)->delete();
    }
}
