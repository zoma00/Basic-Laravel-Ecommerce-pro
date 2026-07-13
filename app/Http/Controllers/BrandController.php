<?php

namespace App\Http\Controllers;

use App\Models\Brand; // Add this at the top
use App\Models\Multipic;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; // <-- This is the correct use
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->middleware('auth');
        $this->imageService = $imageService; // Assign the injected service to the property
    }

    public function AllBrand()
    {

        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ]);

        // Use the injected ImageService to handle image processing
        $last_img = $this->imageService->resizeAndSave($request->file('brand_image'), 300, 200, 'image/brand/');

        // Insert the brand into the database
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        // Brand::insert([
        //     'brand_name' => $request->brand_name,
        //     'brand_image' => $last_img,
        //     'created_at' => Carbon::now(),
        // ]);

        /* Toastr */

        $notification = [
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success',
        ];

        return Redirect()->back()->with($notification);
    }

    public function Edit($id)
    {
        $brands = Brand::find($id);

        return view('admin.brand.edit', compact('brands'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        ],
            [
                'brand_name.required' => 'Please Input Brand Name',
                'brand_name.min' => 'Brand Longer than 4 Characters',
            ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');
        if ($brand_image) {

            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
            /* Toastr */
            $notification = [
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info',
            ];

            return Redirect()->back()->with($notification);

        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now(),
            ]);
            /* Toastr */
            $notification = [
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'warning',
            ];

            return Redirect()->back()->with($notification);
        }

    }

    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        /* Toastr */
        $notification = [
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'error',
        ];

        return Redirect()->back()->with($notification);

    }
    // / This is for Multi image all methods

    public function Multipic()
    {
        $images = Multipic::all();

        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImg(Request $request)
    {
        // Correct validation for multiple images
        $validated = $request->validate([
            'image.*' => 'required|mimes:jpg,jpeg,png|max:2048', // each image
            'image' => 'required|array|min:1',
        ]);

        $files = $request->file('image');

        foreach ($files as $multi_img) {
            // Save resized image to public/image/multi
            $last_img = $imageService->resizeAndSave($multi_img, 300, 300, 'image/multi/');

            Multipic::insert([
                'image' => $last_img, // Save the image path
                'created_at' => Carbon::now(),
            ]);
        }

        return Redirect()->back()->with('success', 'Images Inserted Successfully');
    }

    public function Logout()
    {
        Auth::logout();

        return Redirect()->route('login')->with('success', 'User Logout');
    }
}
