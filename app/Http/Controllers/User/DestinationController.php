<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class DestinationController extends Controller
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

         $destinations = destination::all();
         //authenticates the destinations to their latest update in pages of 5
         //$destinations = destination::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


         $destinations = Destination::paginate(10);

         //brings the user to the index page along with the linked in destinations
         return view('user.destinations.index')->with('destinations', $destinations);
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      // brings the user to their show page when called
      public function show(Destination $destination)
     {
        $user = Auth::user();
        $user->authorizeRoles('user');

        if ($destination->user_id != Auth::id())
        {
            return abort(403);
        }
        //opens up the show page for the user
        return view('user.destinations.show')->with('destination', $destination);
    }
}
