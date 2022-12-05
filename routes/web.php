<?php

use App\Http\Controllers\Admin\TrainController as AdminTrainController;
use App\Http\Controllers\User\TrainController as UserTrainController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\User\DestinationController as UserDestinationController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\User\DriverController as UserDriverController;
use App\Models\destination;
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
Route::get('/home/destinations', [App\Http\Controllers\HomeController::class, 'destinationIndex'])->name('home.destination.index');
Route::get('/home/drivers', [App\Http\Controllers\HomeController::class, 'driverIndex'])->name('home.driver.index');

Route::resource('/admin/trains', AdminTrainController::class)->middleware(['auth'])->names('admin.trains');

Route::resource('/user/trains', UserTrainController::class)->middleware(['auth'])->names('user.trains')->only(['index', 'show']);

Route::resource('/admin/destinations', AdminDestinationController::class)->middleware(['auth'])->names('admin.destinations');

Route::resource('/user/destinations', UserDestinationController::class)->middleware(['auth'])->names('user.destinations')->only(['index', 'show']);

Route::resource('/admin/drivers', AdminDriverController::class)->middleware(['auth'])->names('admin.drivers');

Route::resource('/user/drivers', UserDriverController::class)->middleware(['auth'])->names('user.drivers')->only(['index', 'show']);
