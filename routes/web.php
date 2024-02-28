<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('Admin.index');
//    })->name('dashboard');
//});

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/RegisterPoultry', [App\Http\Controllers\HomeController::class, 'RegisterPoultry'])->name('RegisterPoultry');
Route::get('/eggs', [App\Http\Controllers\HomeController::class, 'eggs'])->name('eggs');
Route::get('/eggsDetails/{id}', [App\Http\Controllers\HomeController::class, 'eggsDetails']);
Route::get('/chickenDetails/{id}', [App\Http\Controllers\HomeController::class, 'chickenDetails']);
Route::get('/sales', [App\Http\Controllers\HomeController::class, 'sales']);

Route::post('/RegisteringChickens',[App\Http\Controllers\OperationController::class, 'RegisterChickens'])->name('RegisteringChickens');

Route::post('/RegisterEggs',[App\Http\Controllers\OperationController::class, 'RegisterEggs'])->name('RegisterEggs');
