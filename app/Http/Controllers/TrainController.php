<?php

namespace App\Http\Controllers;

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
        //authenticates the trains to their latest update in pages of 5
        $trains = train::where('user_id', Auth::id())->latest('updated_at')->paginate(5);

        //brings the user to the index page along with the linked in trains
        return view('trains.index')->with('trains', $trains);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //when called sends the user to the trains create page
    public function create()
    {
        //sends the user to the create page
        return view('trains.create');
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
        //checks if given data is valid before sending to database
        $request->validate([
            'name' => 'required|max:120',
            'cargo' => 'required',
            'image' => 'required',
            'cost' => 'required|between:0,9999.99',
            'destination' => 'required|integer',
        ]);

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
        return to_route('trains.index');
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
        //checks that the trains are the property of the user otheir wise it calls a 403 error
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the show page for the user
        return view('trains.show')->with('train', $train);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //sends the user the the edit page with their selected train
    public function edit(Train $train)
    {
        //call error 403 if the train id is not connected to the user preventing another user from opining the edit page on someone elses train
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the edit page for the user with their selected train
        return view('trains.edit')->with('train', $train);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //pulls the update page with the selected trains data already filled in and prepared to be edited
    public function update(Request $request, Train $train)
    {
        //call error 403 if the train id is not connected to the user preventing another user from editing someone elses train
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        //inserts the current values of the selected page onto the page
        $request->validate([
            'name' => 'required|max:120',
            'cargo' => 'required',
            'image' => 'required',
            'cost' => 'required|between:0,9999.99',
            'destination' => 'required|integer',
        ]);

        //updates the selected trains value to their new values
        $train->update([
            'name' => $request->name,
            'cargo' => $request->cargo,
            'image' => $request->image,
            'cost' => $request->cost,
            'destination' => $request->destination
        ]);

        //returns the user to show page and plays the success message Train updated
        return to_route('trains.show', $train)->with('success', 'Train updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //when called with a train id it allows it to be deleted and sends the user back to the users index page
    public function destroy(Train $train)
    {
        //call error 403 if the train id is not connected to the user preventing another user from deleting someone elses train
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        $train->delete();

        //returns the user to index page and plays the success message Train deleted
        return to_route('trains.index')->with('success', 'Train deleted');
    }
}
