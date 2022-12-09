<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\destination;
use App\Models\driver;
use App\Models\train;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//controlles the placement of the trains table/model across the laravel website
class TrainController extends Controller
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
        $trains = train::with('user')->get();
        $trains = train::all();
        //authenticates the trains to their latest update in pages of 5
        //$trains = train::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $trains = Train::paginate(10);

        //brings the user to the index page along with the linked in trains
        return view('user.trains.index')->with('trains', $trains);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // brings the user to their show page when called
    public function show(Train $train)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $trains = train::with('destination')->with('driver')->get();
        //checks that the trains are the property of the user otheir wise it calls a 403 error
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the show page for the user
        return view('user.trains.show')->with('train', $train);
    }
}
