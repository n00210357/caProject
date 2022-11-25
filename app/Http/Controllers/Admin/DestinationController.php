<?php

namespace App\Http\Controllers\Admin;

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
         $user->authorizeRoles('admin');

         $destinations = destination::all();
         //authenticates the destinations to their latest update in pages of 5
         //$destinations = destination::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


         $destinations = Destination::paginate(10);

         //brings the user to the index page along with the linked in destinations
         return view('admin.destinations.index')->with('destinations', $destinations);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */

      //when called sends the user to the destinations create page
     public function create()
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //sends the user to the create page
         $destination = destination::all();
         return view('admin.destinations.create')->with('destination', $destination);
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */

 //when called it stores the given data for destinations into the database destination table
     public function store(Request $request)
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //checks if given data is valid before sending to database
         $request->validate([
             'location' => 'required',
             'station_master' => 'required|max:120',
             //'picture' => 'required',
             'has_dock' => 'required|integer',
             'has_airport' => 'required|integer',
         ]);

         //$picture = $request->file('picture');
         //$extension = $picture->getClientOriginalExtension();

        // $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

         //$path = $picture->storeAs('public/images', $filename);

         //uses the new data to create a new destination in the destination table
         Destination::create([
             'uuid' => Str::uuid(),
             'user_id' => Auth::id(),
             'location' => $request->location,
             'station_master' => $request->station_master,
             'picture' => $request->picture,
             'has_dock' => $request->has_dock,
             'has_airport' => $request->has_airport
         ]);

         //brings the user to the index page
         $destination = destination::all();
         return to_route('admin.destinations.index')->with('destination',$destination);
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
        $user->authorizeRoles('admin');

        //opens up the show page for the user
        return view('admin.destinations.show')->with('destination', $destination);
    }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

     //sends the user the the edit page with their selected destination
     public function edit(Destination $destination)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the destination id is not connected to the user preventing another user from opining the edit page on someone elses destination
        if ($destination->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the edit page for the user with their selected destination
        $destination = destination::all();
        return view('admin.destinations.edit')->with('destination', $destination)->with('success', 'Destination updated')->with('destination',$destination);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //pulls the update page with the selected destinations data already filled in and prepared to be edited
    public function update(Request $request, Destination $destination)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the destination id is not connected to the user preventing another user from editing someone elses destination
        if ($destination->user_id != Auth::id())
        {
            return abort(403);
        }

        //inserts the current values of the selected page onto the page
        $request->validate([
            'location' => 'required',
            'station_master' => 'required|max:120',
            'picture' => 'required',
            'has_dock' => 'required|integer',
            'has_airport' => 'required|integer',
        ]);

        //updates the selected destinations value to their new values
        $destination->update([
            'location' => $request->location,
            'station_master' => $request->station_master,
            'picture' => $request->picture,
            'has_dock' => $request->has_dock,
            'has_airport' => $request->has_airport
        ]);

        //returns the user to show page and plays the success message Destination updated
        $destination = destination::all();
        return to_route('admin.destinations.show', $destination)->with('success', 'Destination updated')->with('destination',$destination);
    }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      //when called with a destination id it allows it to be deleted and sends the user back to the users index page
     public function destroy(Destination $destination)
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //call error 403 if the destination id is not connected to the user preventing another user from deleting someone elses destination
         if ($destination->user_id != Auth::id())
         {
             return abort(403);
         }

         $destination->delete();

         //returns the user to index page and plays the success message Destination deleted
         return to_route('admin.destinations.index')->with('success', 'Destination deleted');
     }
}
