<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public static function positions_update(){
        $sliders = Slider::orderBy('order', 'ASC')->get();
        $i = 1;
        foreach ($sliders as $slider){
            Slider::where('id', $slider->id)->update(['order' => $i++]);
        }
    }
}
