<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Multipic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!


we can use str value and use echo or return and remove / slash
|


Route::get('/contact', function () {
    return view ('contact'); // Ensure this line ends properly
});
/*->middleware('check');

*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();

    return view('home', compact('brands', 'abouts', 'images'));
});

Route::get('/home', function () {
    echo 'This is Home page';
});

Route::get('/about', function () {
    return view('about'); // Ensure this line ends properly
});

// Route::get('/contactasd-asdf-asdfsad',[ContactController::class, 'index']) ->name('Hazem');

// Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

Route::post('/category/all/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit'])->name('category.edit');
Route::put('/category/update/{id}', [CategoryController::class, 'Update'])->name('category.update');

Route::delete('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete'])
    ->name('categories.softdelete');

Route::get('/category/restore/{id}', [CategoryController::class, 'Restore'])->name('category.restore');
Route::get('/pdelete/category/{id}', [CategoryController::class, 'PDelete'])->name('category.delete');

// For Brand Route

Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit'])->name('brand.edit');
Route::put('brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
Route::delete('/brand/delete/{id}', [BrandController::class, 'Delete'])->name('brand.delete');

// Multi Image Route
Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImg'])->name('store.image');

// Admin All Route

Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

// Home About all Route
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('update/homeabout/{id}', [AboutController::class, 'UpdateAbout'])->name('update.homeabout');
Route::delete('about/delete/{id}', [AboutController::class, 'DeleteAbout']);

// Portfolio page route
Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');

// Admin Contact page routes:

Route::get('admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');
Route::get('admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');

// Home Contact Page Route

Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');

// / Change password and user Profile Route:

Route::get('user/password', [ChangePass::class, 'CPassword'])->name('change.password');
Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');

// User Profile
Route::get('/user/admin-profile', [ChangePass::class, 'PUpdate'])->name('profile.update');
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // $users = User::all();
        // $users = DB::table('users')->get();

        return view('admin.index');
    })->name('dashboard');

});
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');
