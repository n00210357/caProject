<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

        //authenticates the trains to their latest update in pages of 5
        //$trains = train::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $trains = Train::paginate(10);

        //brings the user to the index page along with the linked in trains
        return view('user.trains.index')->with('trains', $trains);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //when called sends the user to the trains create page
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        //sends the user to the create page
        return view('user.trains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

//when called it stores the given data for trains into the database train table
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        //checks if given data is valid before sending to database
        $request->validate([
            'name' => 'required|max:120',
            'cargo' => 'required',
            //'image' => 'required',
            'cost' => 'required|between:0,9999.99',
            'destination' => 'required|integer',
        ]);

        //$image = $request->file('image');
        //$extension = $image->getClientOriginalExtension();

        //$filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

        //$path = $image->storeAs('public/images', $filename);

        //uses the new data to create a new train in the train table
        Train::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'name' => $request->name,
            'cargo' => $request->cargo,
            'image' => $request->image,
            'cost' => $request->cost,
            'destination' => $request->destination
        ]);

        //brings the user to the index page
        return to_route('user.trains.index');
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

        //checks that the trains are the property of the user otheir wise it calls a 403 error
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the show page for the user
        return view('user.trains.show')->with('train', $train);
    }
}
