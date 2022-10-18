<?php

namespace App\Classes;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Imgstore
{

    public static function setCarImage($image){
        if(isset($image))
        {
            Image::make($image)->encode('webp', 80)->fit(300, 200)->save();
            $imgfilename = uniqid() . '.webp';
            Storage::disk('public')->put('cars/' . $imgfilename, fopen($image, 'r+'));
            return $imgfilename;
        }
    }

    public static function delete($image){
        Storage::disk('public')->delete('cars/'.$image);
    }


}