<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import band model
use App\Models\Band;

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
    public function create()
    {
        $bands = Band::orderby('band_name', 'desc')->pluck('band_name', 'id');
        return view('band.create', compact('bands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate input data
        $request->validate([
            'band_name' => 'required',
            'bio' => 'required',
            'photo' => 'required'
        ]);
        // Send data to database
        Band::create($request->all());
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
        // edit band
        return view('band.edit', compact('band'));
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

        // validate input data
        $request->validate([
            'band_name' => 'required',
            'bio' => 'required'
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
        // Get band id and delete
        $band->delete();
        // Redirect to index
        return redirect('/band')->with('success', 'Band deleted!');
    }
}
