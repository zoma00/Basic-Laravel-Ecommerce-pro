<?php

namespace App\Http\Controllers;
use App\Services\ImageService; // Add this at the top

use Illuminate\Http\Request;
use App\Models\Category;  
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    } 



    public function AllCat(){
        // $categories = DB::table('categories')
        //     ->join('users','categories.user_id','users.id')
        //     ->select('categories.*','users.name')
        //     ->latest()->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trachCat = Category::onlyTrashed()->latest()->paginate(3);
        $categories = Category::withTrashed()->paginate(5);


        //$categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index',compact('categories','trachCat'));
    }

    public function AddCat(Request $request){
        $validated = $request->validate([
            // Fix table name from posts to categories
            'category_name' => 'required|unique:categories|max:255',  
        ],
            [

                'category_name.required' => 'Please Input Category Name',  
                'category_name.max' => 'Category less Than 255Char',  

        ]);

        Category::insert ([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at'=> Carbon::now()
        ]);

        //This is better format because it insert the update at dynamically.
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] =  Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success','Category inserted successfully');


    }

    // public function Edit($id){
    //     $categories = Category::find($id);
    //     return view('admin.category.edit', compact('categories'));
    // }


    // CategoryController.php
public function Edit($id) {
    //$category = Category::findOrFail($id);  // Use singular variable name
    $category = DB::table('categories')->where('id',$id)->first();
    return view('admin.category.edit', compact('category'));
}

public function Update(Request $request, $id) {
//     $category = Category::findOrFail($id);
//     $category->update([
//         'category_name' => $request->category_name,
//         'user_id' => Auth::user()->id
//     ]);


$data = array();
$data['category_name'] = $request->category_name;
//$data['user_id'] = Auth::user()->id;
Category::findOrFail($id)->update($data);


return redirect()->route('all.category')->with('success','Category Updated 
Successfully');


}


public function SoftDelete($id)  
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->back()
        ->with('success', 'Category Soft Deleted Successfully');
}


public function index() {
  $categories = Category::latest()->paginate(5);
  $trachCat = Category::onlyTrashed()->latest()->paginate(5); // Get trashed items
  return view('admin.category.index', compact('categories', 'trachCat'));
}

public function Restore($id) {

    $category = Category::withTrashed()->find($id);
    
    if (!$category) {
        return redirect()->route('all.category')->with('error', 'Category not found');
    }

    $category->restore();

    return redirect()->route('all.category')->with('success', 'Category restored successfully');
} 

    public function PDelete($id){
        $category = Category:: onlyTrashed()->find($id)->forceDelete();
        if (!$category) {
            return redirect()->route('all.category')->with('error', 'Category not found');
    }


    return redirect()->route('all.category')->with('success', 'Category Permanently deleted successfully');


    }



}