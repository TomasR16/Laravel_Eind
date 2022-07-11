<?php

namespace App\Http\Controllers;

// use request for handeling data
use Illuminate\Http\Request;

// import Models
use App\Models\Band;
use App\Models\BandUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Band_controller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // get all bands from Band object 
        $band = Band::all();
        // return to view with band
        return view('band.index', compact('band'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Band $band)
    {
        // select name and id from User object
        $users = User::pluck('name', 'id');
        // return view band edit with values
        return view('band.create', compact('band', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Band $band)
    {
        // validate input data
        $request->validate([
            'band_name' => 'required',
            'bio' => 'required',
            'photo' => 'required'
        ]);
        // dd($band, $request);
        // Create new band
        $band = Band::create($request->all());
        // Check if input is empty 
        if (!empty($request->input()['users'])) {
            // Add users to band
            $band->users()->sync($request->input()['users']);
        }
        // Go to index
        return redirect()->route('band.index')->with('success', 'Band created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Band $band)
    {
        // Show band EPK
        return view('band.show', compact('band'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Band $band)
    {
        // select name and id from User object
        $users = User::all('name', 'id');

        // return view band edit with values
        return view('band.edit', compact('band', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Band $band)
    {

        // attach an user to band
        $band->users()->syncWithoutDetaching($request->input()['users']);

        // validate input data
        $request->validate([
            'band_name' => 'required',
            'bio' => 'required',
            'photo' => 'required'
        ]);
        // update band object
        $band->update($request->all());
        // return to index
        return redirect('/band')->with('success', 'Band updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Band $band)
    {
        //dd($band);
        // detach users from band
        $band->users()->detach();
        // Get band id and delete
        $band->delete();
        // Redirect to index
        return redirect('/band')->with('success', 'Band deleted!');
    }
}
