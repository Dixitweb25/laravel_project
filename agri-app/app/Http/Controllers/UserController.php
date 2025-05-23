<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// mail import
use App\Mail\WelcomeUserMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function loginUser(Request $request)
    {
        // Validate login inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password does not match.');
        }

        if (!$user->is_active) {
            return redirect()->back()->with('error', 'Your account is blocked.');
        }

        // Login the user
        Auth::login($user);
        return redirect('/')->with('success', 'Logged in successfully!');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'mobile_no' => 'required',
            'location' => 'required',
            'password' => 'required|min:6',
        ]);

        $password = $request->password; // save plain password temporarily

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'mobile_no' => $request->mobile_no,
            'location' => $request->location,
            'password' => Hash::make($request->password),
            'is_active' => 1,
        ]);

        // Send Welcome Email
        Mail::to($request->email)->send(new WelcomeUserMail(
            $request->email,
            $password,
            url('http://127.0.0.1:8000/login')
        ));

        return redirect('login')->with('success', 'User created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $user = Auth::user();
        return view('web.edit_profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'location' => 'required',
        ]);

        $user = Auth::user();
        $user->update($request->only('full_name', 'email', 'gender', 'mobile_no', 'location'));

        return redirect('profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
