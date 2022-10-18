<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id', 'name', 'email', 'address', 'phone', 'date_start', 'date_end', 'price',
      ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
