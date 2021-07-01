<?php
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});


// Route::resource('invoice', InvoiceController::class);
// Route::resource('user', UserController::class);

Route::post('/invoice/create', [InvoiceController::class, 'create']);
Route::post('/user/create', [UserController::class, 'create']);
Route::get('/user', [UserController::class, 'index']);