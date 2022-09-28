<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// import Models
use App\Models\Band;
use App\Models\BandUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function index()
    {
        if (Auth::user()) {
            $users = Auth::user();
            return view('profile.index', compact('users'));
        } else {
            return redirect()->route('band.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Get user object
        // $users = Auth::user()->id;
        // return view with user object 
        if (Auth::user()) {
            return view('profile.edit');
        } else {
            return redirect()->route('band.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user = Auth::user();
        //validation rules
        // $request->validate([
        //     'name' => 'string',
        //     'email' => 'required|between:3,64|email|unique:users',
        //     'password' => 'string'
        // ]);

        $user->name = $request->name;
        $user->email = $request->email;
        // Als user password niet gelijk is aan wachtwoord in request maak new ww
        // if ($user->password != $request->password) {
        //     $user->password = Hash::make($request->password);
        // }
        $user->save($request->all());

        // return to index
        return redirect('/profile')->with('success', 'Profile updated');
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
