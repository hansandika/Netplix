<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $attr = $request->validate([
            'username' => 'required', 'unique:users,username',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'confirm-password' => ['required', 'same:password']
        ]);

        $latestUser = DB::table('users')->latest('date_joined')->first();
        $lastUser = substr($latestUser->user_id, -3);
        $countUser = (int)$lastUser + 1;

        $attr['user_id'] = 'USR';
        if ($countUser < 10) {
            $attr['user_id'] .= (string)'00';
        } else if ($countUser < 100) {
            $attr['user_id'] .= (string)'0';
        }
        $attr['user_id'] .= $countUser;

        $attr['name'] = $attr['username'];
        $attr['date_joined'] = Carbon::now();
        $attr['password'] = bcrypt($attr['password']);
        $attr['id'] = $countUser;
        User::create($attr);

        return redirect('/login');
    }
}
