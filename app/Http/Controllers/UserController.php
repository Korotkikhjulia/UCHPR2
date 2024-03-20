<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        $title = 'Registration';
        return view('user.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Username' => 'required',
            'password' => 'required|confirmed',
            'Email' => 'required|email|unique:users',
            'UserPhoto'=>'nullable|image',
        ]);

        if ($request->hasFile('UserPhoto')) {
            $folder = date('Y-m-d');
            $UserPhoto = $request->file('UserPhoto')->store("public/images/$folder");
        }

        $user = User::create([
            'Username'=>$request->Username,
            'password'=>Hash::make($request->password),
            'Email'=>$request->Email,
            'UserPhoto' => $UserPhoto ?? null,
        ]);
        session()->flash('success', 'Регистрация пройдена');
        Auth::login($user);
        return redirect()->route('home');
    }

    public function loginCreate()
    {
        $title = 'Autorisation';
        return view('user.login.create', compact('title'));
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt([
            'Email' => $request->Email,
            'password' => $request->password,
        ]))
        {
            return redirect()->route('home')->with('success', 'Авторизация пройдена');
        } else{
        return redirect()->back()->with('error', 'Некорректный логин или пароль');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
