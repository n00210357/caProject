<?php

namespace App\Http\Controllers\Admin;

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
        $user->authorizeRoles('admin');

        $drivers = driver::with('user')->get();
        $drivers = driver::all();
        //authenticates the drivers to their latest update in pages of 5
        //$drivers = driver::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $drivers = Driver::paginate(10);

        //brings the user to the index page along with the linked in drivers
        return view('admin.drivers.index')->with('drivers', $drivers);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //when called sends the user to the driverss create page
     public function create()
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //sends the user to the create page
         $trains = train::all();
         return view('admin.drivers.create')->with('trains', $trains);
     }

     //when called it stores the given data for drivers into the database driver table
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //checks if given data is valid before sending to database
        $request->validate([
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'certification' => 'required',
            //'image' => 'required',
            'photo' => 'file|image',
            'salary' => 'required|between:0,9999.99',
            'train' =>['required' , 'exists:trains,id']
        ]);

        $photo = $request->file('photo');
        $extension = $photo->getClientOriginalExtension();
        // the name $namefile needs to be unique, I use title and add the date to guarantee a unique name$namefile, ISBN would be better here.
        $namefile = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
        $path = $photo->storeAs('public/images/driver', $namefile);

        //uses the new data to create a new train in the drive table
        $driver = Driver::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'certification' => $request->certification,
            'photo' => $namefile,
            'salary' => $request->salary
        ]);

        //brings the user to the index page
        $driver->train()->attach($request->train);
        return to_route('admin.drivers.index');
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
        $user->authorizeRoles('admin');

        $drivers = driver::with('train')->get();
        //checks that the drivers are the property of the user otheir wise it calls a 403 error
        if ($driver->user_id != Auth::id())
        {
            return abort(403);
        }
        $trains = train::with('destination')->with('driver')->get();
        //opens up the show page for the user
        return view('admin.drivers.show')->with('driver', $driver);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //sends the user the the edit page with their selected driver
    public function edit(Driver $driver)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the driver id is not connected to the user preventing another user from opining the edit page on someone elses driver
        if ($driver->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the edit page for the user with their selected driver
        return view('admin.drivers.edit')->with('driver', $driver)->with('success', 'Driver updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //pulls the update page with the selected drivers data already filled in and prepared to be edited
    public function update(Request $request, Driver $driver)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the driver id is not connected to the user preventing another user from editing someone elses driver
        if ($driver->user_id != Auth::id())
        {
            return abort(403);
        }

        //checks if given data is valid before sending to database
        $request->validate([
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'certification' => 'required',
            'photo' => 'file|image',
            'salary' => 'required|between:0,9999.99'
        ]);

        $photo = $request->file('photo');
        $extension = $photo->getClientOriginalExtension();
        // the name $namefile needs to be unique, I use title and add the date to guarantee a unique name$namefile, ISBN would be better here.
        $namefile = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
        $path = $photo->storeAs('public/images/driver', $namefile);

        //updates the selected drivers value to their new values
        $driver->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'certification' => $request->certification,
            'photo' => $namefile,
            'salary' => $request->salary
        ]);

        //returns the user to show page and plays the success message Driver updated
        return to_route('admin.drivers.show', $driver)->with('success', 'Driver updated');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //when called with a driver id it allows it to be deleted and sends the user back to the users index page
     public function destroy(Driver $driver)
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //call error 403 if the driver id is not connected to the user preventing another user from deleting someone elses driver
         if ($driver->user_id != Auth::id())
         {
             return abort(403);
         }

         $driver->delete();

         //returns the user to index page and plays the success message Driver deleted
         return to_route('admin.drivers.index')->with('success', 'Driver deleted');
     }
}
