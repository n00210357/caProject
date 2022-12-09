<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\destination;
use App\Models\driver;
use App\Models\train;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//controlles the placement of the drivers table/model across the laravel website
class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // The part of the controller that sends the user and their select data to the index page
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $drivers = driver::with('user')->get();
        $drivers = driver::all();
        //authenticates the drivers to their latest update in pages of 5
        //$drivers = driver::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $drivers = Driver::paginate(10);

        //brings the user to the index page along with the linked in drivers
        return view('user.drivers.index')->with('drivers', $drivers);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      // brings the user to their show page when called
      public function show(Driver $driver)
     {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $drivers = driver::with('train')->get();
        //checks that the drivers are the property of the user otheir wise it calls a 403 error
        if ($driver->user_id != Auth::id())
        {
            return abort(403);
        }
        $trains = train::with('destination')->with('driver')->get();
        //opens up the show page for the user
        return view('user.drivers.show')->with('driver', $driver);
    }
}
