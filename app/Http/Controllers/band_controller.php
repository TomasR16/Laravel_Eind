<?php

namespace App\Http\Controllers;

// use request for handling data
use Illuminate\Http\Request;

// import Models
use App\Models\Band;
use App\Models\BandUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Symfony\Component\HttpFoundation\RequestStack;

class Band_controller extends Controller
{
    // Contructor method 
    public function __construct()
    {
        // Must be logged in to see contacts!
        $this->middleware('auth', ['except' => ['login', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        // ophalen $keyword uit Request object
        $keyword = $request->keyword;

        // Als $keyword gevuld is
        if (isset($keyword)) {
            // Zoek keyword in Band::contactSearch
            $band = Band::bandSearch($keyword);
        } else {
            // Haal alle Contacten
            $band = Band::all();
        }

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
        if (Auth::user()) {
            $users = User::pluck('name', 'id');
            return view('band.create', compact('band', 'users'));
        } else {
            return redirect()->route('login');
        }
        // return view band edit with values
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
            // nullable == optional
            // apache max upload 2mb
            'photo' => 'image|nullable|max:1999'
        ]);

        // Create new band
        $band = Band::create($request->all());

        // Check if input is empty 
        if (!empty($request->input()['users'])) {
            // Add users to band
            $band->users()->sync($request->input()['users']);
        }

        // Handle File Upload
        if ($request->hasFile('photo')) {
            // Get filename with extension            
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('photo')->storeAs('public/photo', $fileNameToStore);
            $band->photo = $fileNameToStore;
        }

        $band->save();
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
        if (Auth::user()) {
            return view('band.show', compact('band'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Band $band)
    {
        if (Auth::user()) {
            // select name and id from User object
            $users = User::all('name', 'id');

            // return view band edit with values
            return view('band.edit', compact('band', 'users'));
        } else {
            return redirect()->route('login');
        }
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
            'photo' => 'image|nullable|max:1999'
        ]);
        $oldImage = $band->photo;
        //dd($oldImage);

        // Update band fields name etc.
        $band->update($request->all());


        // Handle File Upload
        if ($request->hasFile('photo')) {

            Storage::delete('/public/photo/' . $oldImage);

            // Get filename with extension            
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('photo')->storeAs('public/photo', $fileNameToStore);


            // get file name in storage/photo form Ariane5_1657926082.jpg
            $band->photo = $fileNameToStore;
            // update existing model
            $band->save();
        }

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
