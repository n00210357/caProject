<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //some authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    //bring the home controller to the train index page and checks if user is admin
    public function index()
    {
        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin'))
        {
            $home = 'admin.trains.index';
        }
        else if ($user->hasRole('user'))
        {
            $home = 'user.trains.index';
        }
        return redirect()->route($home);
    }

    //bring the home controller to the destination index page and checks if user is admin
    public function destinationIndex(Request $request)
    {
        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin'))
        {
            $home = 'admin.destinations.index';
        }
        else if ($user->hasRole('user'))
        {
            $home = 'user.destinations.index';
        }
        return redirect()->route($home);
    }

    //bring the home controller to the driver index page and checks if user is admin
    public function driverIndex(Request $request)
    {
        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin'))
        {
            $home = 'admin.drivers.index';
        }
        else if ($user->hasRole('user'))
        {
            $home = 'user.drivers.index';
        }
        return redirect()->route($home);
    }
}
