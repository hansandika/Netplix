<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if ($request->url) {
            $attr = $request->validate([
                'url' => ['required']
            ]);
            $user->image_url = $attr['url'];
            $user->save();
            return redirect('/profile')->with('success', 'Profile image has been updated');
        }

        $attr = $request->validate([
            'username' => ['required'],
            'email' => 'required|email',
            'dob' => ['required', 'date'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:5', 'max:13']
        ]);

        $user->name = $attr['username'];
        $user->email = $attr['email'];
        $user->dob = $attr['dob'];
        $user->phone = $attr['phone'];
        $user->save();

        return redirect('/profile')->with('success', 'User has been updated');
    }
}
