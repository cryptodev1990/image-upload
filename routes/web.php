<?php

use App\Http\Controllers\ImageUploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//For adding an image
Route::get('/add-image',[ImageUploadController::class, 'addImage'])->name('images.add');

//For storing an image
Route::post('/store-image', [ImageUploadController::class, 'storeImage'])->name('images.store');

//For showing an image
Route::get('/view-image',[ImageUploadController::class, 'viewImage'])->name('images.view');

Route::get('/', function () {
    return view('welcome');
});
