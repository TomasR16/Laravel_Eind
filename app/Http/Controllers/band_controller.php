<?php

namespace App\Http\Controllers;

// use request for handling data
use Illuminate\Http\Request;

// import Models
use App\Models\Band;
use App\Models\BandUser;
use App\Models\User;
use App\Models\Youtube;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use Symfony\Component\HttpFoundation\RequestStack;

class Band_controller extends Controller
{
    // Contructor method 
    public function __construct()
    {
        // Must be logged in to see anything!
        $this->middleware('auth', ['except' => ['login', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        // Get $keyword from request object
        $keyword = $request->keyword;

        // If keyword is filled 
        if (isset($keyword)) {
            // Call static method bandsearch for keyword
            $band = Band::bandSearch($keyword);
        } else {
            // Return all contacts
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
        if (Auth::user()) {
            // select name and id from User object
            $users = User::pluck('name', 'id');
            return view('band.create', compact('band', 'users'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Band $band, Youtube $video)
    {

        // validate input data
        $request->validate([
            'band_name' => 'required',
            'bio' => 'required',
            'url' => 'required',
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
            // Store file in storage\public\photo
            $path = $request->file('photo')->storeAs('public/photo', $fileNameToStore);
            // Store file as band->photo
            $band->photo = $fileNameToStore;
        }

        // Send data to database
        $band->save();

        // Make new object for URL's
        $video = new Youtube();

        // Get band_id
        $video->band_id = $band->id;

        // Find current band
        $band = Band::find($video->band_id);

        // Get url from input
        $video->url = $request->input('url');
        // save url to database
        $band->youtubes()->save($video);

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
        // get youtube videos from object
        $youtube = Youtube::all();

        if (Auth::user()) {
            // Show band EPK
            return view('band.show', compact('band', 'youtube'));
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
    public function update(Request $request, Band $band, Youtube $video)
    {

        // attach an user to a band
        $band->users()->syncWithoutDetaching($request->input()['users']);

        // validate input data
        $request->validate([
            'band_name' => 'required',
            'bio' => 'required',
            'photo' => 'image|nullable|max:1999',
            'url' => 'required'
        ]);
        // store old image 
        $oldImage = $band->photo;

        // Update band fields name etc.
        $band->update($request->all());

        // Get band_id
        $video->band_id = $band->id;
        // Find current band
        $band = Band::find($video->band_id);
        // Delete old band youtubes field 
        $band->youtubes()->delete($band);
        // Get url from input
        $video->url = $request->input('url');
        // Save new URL to youtubes
        $band->youtubes()->save($video);

        // Handle new File Upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            Storage::delete('/public/photo/' . $oldImage);

            // Get filename with extension            
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('photo')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Store file in storage\public\photo
            $path = $request->file('photo')->storeAs('public/photo', $fileNameToStore);
            // store file as band->photo
            $band->photo = $fileNameToStore;
            // update existing model object 
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
        // detach users from band
        $band->users()->detach();
        // Get band id and delete
        $band->delete();
        // Redirect to index
        return redirect('/band')->with('success', 'Band deleted!');
    }
}
