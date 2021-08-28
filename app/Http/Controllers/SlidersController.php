<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlidersController extends Controller
{
    public function sliders(Request $request)
    {
        if ($request->method() == 'DELETE') {
            $slider = Slider::findOrFail($request->input('id'));
            $slider->delete();
            Slider::positions_update();
            \Session::flash('flash', 'Слайдер ' . $slider->title . ' успешно удален.');

            return back();
        }
        return view('Admin.Sliders.sliders', [
                'sliders' => Slider::orderBy('order', 'ASC')->get(),
                'max' => Slider::max('order'),
            ]
        );
    }

    public function deactivate($id)
    {
        $data = Slider::findOrFail($id);
        if ($data->is_active == 1)
            Slider::where('id', $id)->update(['is_active' => 0]);
        else
            Slider::where('id', $id)->update(['is_active' => 1]);

        return back();
    }

    public function add(Request $request)
    {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'title' => 'string | required | min: 3 | max:255',
                    'text' => 'required | min: 10 | max:1000',
                    'small_image' => 'required | image',
                    'big_image' => 'required | image',
                ]
            );
            $slider = new Slider();
            $slider->title = $request->input('title');
            $slider->text = $request->input('text');

            $small_image = $request->small_image;
            if ($small_image) {
                $smallImageName = rand(0, 10000) . time() . stristr($small_image->getClientOriginalName(), '.');
                $small_image->move('images/slider/flexslider', $smallImageName);
                $slider->small_image = $smallImageName;
            }

            $big_image = $request->big_image;
            if ($big_image) {
                $bigImageName = rand(0, 10000) . time() . stristr($big_image->getClientOriginalName(), '.');
                $big_image->move('images/slider/flexslider', $bigImageName);
                $slider->big_image = $bigImageName;
            }
            $slider->order = Slider::max('order') + 1;
            $slider->save();

            \Session::flash('flash', 'Слайд ' . $slider->title . ' успешно добавлен.');

            return redirect()->route('sliders');
        }

        return view('Admin.Sliders.slider_add');

    }

    public function edit(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'title' => 'string | required | min: 3 | max:255',
                    'text' => 'required | min: 10 | max:1000',
                    'small_image' => 'image',
                    'big_image' => 'image',
                ]
            );
            $slider = Slider::findOrFail($id);
            $slider->title = $request->input('title');
            $slider->text = $request->input('text');

            $small_image = $request->small_image;
            if ($small_image) {
                $smallImageName = rand(0, 10000) . time() . stristr($small_image->getClientOriginalName(), '.');
                $small_image->move('images/slider/flexslider', $smallImageName);
                $slider->small_image = $smallImageName;
            }

            $big_image = $request->big_image;
            if ($big_image) {
                $bigImageName = rand(0, 10000) . time() . stristr($big_image->getClientOriginalName(), '.');
                $big_image->move('images/slider/flexslider', $bigImageName);
                $slider->big_image = $bigImageName;
            }
            $slider->save();

            \Session::flash('flash', 'Слайд ' . $slider->title . ' успешно обновлен.');

            return redirect()->route('sliders');
        }

        return view('Admin.Sliders.slider_edit', ['slider' => Slider::findOrFail($id)]);
    }

    public function up($id)
    {
        $order = Slider::where('id', $id)->value('order');
        Slider::where('order', $order - 1)->update(['order' => $order]);
        Slider::where('id', $id)->update(['order' => $order - 1]);

        return back();
    }

    public function down($id)
    {
        $order = Slider::where('id', $id)->value('order');
        Slider::where('order', $order + 1)->update(['order' => $order]);
        Slider::where('id', $id)->update(['order' => $order + 1]);

        return back();
    }
}
