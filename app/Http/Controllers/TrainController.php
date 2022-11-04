<?php

namespace App\Http\Controllers;

use App\Models\train;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $trains = train::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        return view('trains.index')->with('trains', $trains);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trains.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120',
            'cargo' => 'required',
            'image' => 'required',
            'cost' => 'required|between:0,9999.99',
            'destination' => 'required|integer',
        ]);

        Train::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'name' => $request->name,
            'cargo' => $request->cargo,
            'image' => $request->image,
            'cost' => $request->cost,
            'destination' => $request->destination
        ]);

        return to_route('trains.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Train $train)
    {
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        return view('trains.show')->with('train', $train);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Train $train)
    {
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        return view('trains.edit')->with('train', $train);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Train $train)
    {
        if ($train->user_id != Auth::id())
        {
            return abort(403);
        }

        $request->validate([
            'name' => 'required|max:120',
            'cargo' => 'required',
            'image' => 'required',
            'cost' => 'required|between:0,9999.99',
            'destination' => 'required|integer',
        ]);

        $train->update([
            'name' => $request->name,
            'cargo' => $request->cargo,
            'image' => $request->image,
            'cost' => $request->cost,
            'destination' => $request->destination
        ]);

        return to_route('trains.show', $train);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
