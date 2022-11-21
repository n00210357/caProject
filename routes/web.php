<?php

use App\Http\Controllers\Admin\TrainController as AdminTrainController;
use App\Http\Controllers\User\TrainController as UserTrainController;
use Database\Seeders\TrainSeeder;
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

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::resource('/admin/trains', AdminTrainController::class)->middleware(['auth'])->names('admin.trains');

Route::resource('/user/trains', UserTrainController::class)->middleware(['auth'])->names('user.trains')->only(['index', 'show']);
