<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id', 'name', 'slug', 'image', 'status', 'price'
  ];

  public function rental()
  {
    return $this->hasMany(Rental::class);
  }

  public function image()
  {
    $imageSource = ($this->image) ? $this->image : 'default.webp';
    return '/storage/cars/' . $imageSource;
  }
}
