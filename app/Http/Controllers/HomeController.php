<?php

namespace App\Http\Controllers;
use App\Services\ImageService; // Add this at the top

// use Intervention\Image\ImageManager;
//  use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth; // <-- This is the correct use
use Illuminate\Support\Carbon;
class HomeController extends Controller
{
    public function HomeSlider(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function AddSlider(){
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){
        $validated = $request->validate([
        'title' => 'required|min:4',
        'image' => 'required|mimes:jpg,jpeg,png',
    ]);

    $slider_image = $request->file('image');
    $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();

    // Using v3 ImageManager (no facade!)
$imageService = new ImageService();
$last_img = $imageService->resizeAndSave($request->file('image'), 1920, 1088, 'image/slider/');

Slider::insert([
    'title' => $request->title,
    'description' => $request->description,
    'image' => $last_img,
    'created_at' => Carbon::now(),
]);

    // $manager = new ImageManager(new Driver());

    // $manager->read($slider_image)
    // ->resize(1920, 1088)
    // ->save(public_path('image/slider/' . $name_gen));


    // $last_img = 'image/slider/' . $name_gen;

    // Slider::insert([
    //     'title' => $request->title,
    //     'description' => $request->description,

    //     'image' => $last_img,
    //     'created_at' => Carbon::now(),
    // ]);

    return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfully');
    }
}
