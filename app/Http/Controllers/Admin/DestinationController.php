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
         'picture' => 'file|image',
         'has_dock' =>'required|integer',
         'has_airport' =>'required|integer'
     ]);

     $picture = $request->file('picture');
     $extension = $picture->getClientOriginalExtension();
     // the filnam needs to be unique, I use title and add the date to guarantee a unique filnam, ISBN would be better here.
     $filnam = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
     $path = $picture->storeAs('public/images/train', $filnam);

     //uses the new data to create a new train in the train table
     Destination::create([
         'uuid' => Str::uuid(),
         'user_id' => Auth::id(),
         'location' => $request->location,
         'station_master' => $request->station_master,
         'picture' => $filnam,
         'has_dock' => $request->has_dock,
         'has_airport' => $request->has_airport
     ]);

     //brings the user to the index page
     $destination = destination::all();
     return to_route('admin.trains.index')->with('destination',$destination);
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

        return view('admin.destinations.edit')->with('destination', $destination);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
      //  dd($request);
        //   //This function is quite like the store() function.
          $request->validate([
            'location' => 'required',
            'station_master' => 'required',
            'picture' => 'required|max:500',
            'has_dock' =>'required|integer',
            'has_airport' =>'required|integer',
            //'picture' => 'file|picture|dimensions:width=300,height=400'
           'picture' => 'file|picture'
        ]);

        $picture = $request->file('picture');
        $extension = $picture->getClientOriginalExtension();
        // the filnam needs to be unique, I use title and add the date to guarantee a unique filnam, ISBN would be better here.
        $filnam = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
        $path = $picture->storeAs('public/images/destination', $filnam);

        $destination->update([
            'location' => $request->location,
            'station_master' => $request->station_master,
            'picture' => $filnam,
            'has_dock' => $request->has_dock,
            'has_airport' => $request->has_airport,
        ]);

        return to_route('admin.destinations.show', $destination)->with('success','Destination updated successfully');
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
