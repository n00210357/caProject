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

    public function __construct()
    {
        $this->middleware('auth');
    }


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
