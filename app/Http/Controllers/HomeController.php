<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget('cart');
        // dump(session('cart')[1]['title']);
        dump(session()->all());

        $categories = Categories::orderBy('id')->get();

        $title = 'Home page';
        // $posts = Post::orderBy('id', 'desc')->paginate(3);
        // return view('home', compact('title', 'posts'));
        return view('home', compact('categories'));


        
    }
}
