<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Arr;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Advertisements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cat = $request->Cat;
        $title = 'Home page';
        $categories = Categories::orderBy('id')->get();
        if ($sear = $request->search) {
            if ($cat == 'Выберите категорию' || $cat == '') {
                $request->session()->forget('cart');
                $Ads = Advertisements::orderBy('id', 'desc')->where([
                    ['Title', $sear],
                    ['Status', 'Y']
                ])->paginate(3);
            } else {
                $Ads = Advertisements::orderBy('id', 'desc')->where([
                    ['Title', $sear],
                    ['CategoryID', $cat],
                    ['Status', 'Y']
                ])->paginate(3);
            }
        } else {
            if ($cat == 'Выберите категорию' || $cat == '') {
                $request->session()->forget('cart');
                $Ads = Advertisements::orderBy('id', 'desc')->where('Status', 'Y')->paginate(3);
            } else {
                $Ads = Advertisements::orderBy('id', 'desc')->where([
                    ['CategoryID', $cat],
                    ['Status', 'Y']
                ])->paginate(3);
            }
        }

        return view('home', compact('title', 'Ads', 'categories', 'cat'));
    }

    public function index2(Request $request)
    {
        $cat = $request->Cat;
        $title = 'Home page';
        $categories = Categories::orderBy('id')->get();
        $categories = Categories::orderBy('id')->get();
        if ($sear = $request->search) {
            if ($cat == 'Выберите категорию' || $cat == '') {
                $request->session()->forget('cart');
                $Ads = Advertisements::orderBy('id', 'desc')->where([
                    ['Title', $sear],
                    ['Status', 'Y']
                ])->paginate(3);
            } else {
                $Ads = Advertisements::orderBy('id', 'desc')->where([
                    ['Title', $sear],
                    ['CategoryID', $cat],
                    ['Status', 'Y']
                ])->paginate(3);
            }
        } else {
            if ($cat == 'Выберите категорию' || $cat == '') {
                $request->session()->forget('cart');
                $Ads = Advertisements::orderBy('id', 'desc')->where('Status', 'Y')->paginate(3);
            } else {
                $Ads = Advertisements::orderBy('id', 'desc')->where([
                    ['CategoryID', $cat],
                    ['Status', 'Y']
                ])->paginate(3);
            }
        }
        return view('home', compact('title', 'Ads', 'categories', 'cat'));
    }

    public function create()
    {
        $title = 'Create Page';
        $categories = Categories::pluck('CategoryName', 'id')->all();
        return view('create', compact('title', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'CategoryID' => 'required|integer',
                'Title' => 'required|min:5|max:100',
                'Description' => 'required',
                'AdPhoto' => 'required|image',
            ],
            [
                'CategoryID.required' => 'Заполните поле CategoryID',
                'CategoryID.integer' => 'Поле не является числом',
                'Title.required' => 'Заполните поле Title',
                'Title.min' => 'Минимум 5 символов',
                'Title.max' => 'Максимум 100 символов',
                'Description.required' => 'Заполните поле Description',
            ]
        );

        if ($request->hasFile('AdPhoto')) {
            $folder = date('Y-m-d');
            $AdPhoto = $request->file('AdPhoto')->store("public/images/{$folder}");
        }

        Advertisements::create([
            'UserID' => Auth::user()->id,
            'CategoryID' => $request->CategoryID,
            'Title' => $request->Title,
            'Description' => $request->Description,
            'AdPhoto' => $AdPhoto,
            'Status' => 'Ex'
        ]);
        return redirect()->route('home');
    }

    public function Otz()
    {
        $title = 'Otz';
        return view('otz', compact('title'));
    }

    public function cart(Request $request)
    {
        $title = 'Cart';
        $uid = Auth::user()->id;
        $pid = $request->post;
        $categories = Categories::orderBy('id')->get();
        $Ads = DB::table('carts')
            ->join('advertisements', 'carts.postid', '=', 'Advertisements.id')
            ->join('users', 'carts.userid', '=', 'users.id')
            ->select('advertisements.*')
            ->where([
                ['users.id', $uid],
            ])
            ->paginate(3);
        Cart::firstOrCreate([
            'userid' => Auth::user()->id,
            'postid' => $pid,
        ]);
        $Ads = DB::table('carts')
            ->join('advertisements', 'carts.postid', '=', 'Advertisements.id')
            ->join('users', 'carts.userid', '=', 'users.id')
            ->select('advertisements.*')
            ->where([
                ['users.id', $uid],
            ])
            ->paginate(3);

            return redirect()->route('home')->with('success', 'Вы добавиили пост в корзину');
    }

    public function cartt(Request $request)
    {
        $title = 'Cart';
        $uid = Auth::user()->id;
        $categories = Categories::orderBy('id')->get();
        $Ads = DB::table('carts')
            ->join('advertisements', 'carts.postid', '=', 'Advertisements.id')
            ->join('users', 'carts.userid', '=', 'users.id')
            ->select('advertisements.*')
            ->where([
                ['users.id', $uid],
            ])
            ->paginate(3);
        return view('user.cart', compact('title', 'Ads', 'categories'));
    }

    public function cartdel(Request $request)
    {
        $pp = $request->post;
        $pp = DB::table('carts')
            ->join('advertisements', 'carts.postid', '=', 'Advertisements.id')
            ->select('carts.id')
            ->where([
                ['advertisements.id', $pp],
            ])
            ->first();
        $post = '';
        foreach ($pp as $p) {
            $post .= Cart::find($p);
        }
        $post = Cart::find($p);
        $post->delete();
        return redirect()->route('post.cartt')->with('success', 'Вы убрали пост из корзины');
        // return view('user.cart', compact('title', 'Ads', 'categories'))->with('success', 'Удаление поста прошло успешно');
    }

    public function cartbuy(Request $request)
    {
        $title = 'Buy';
        $pos = $request->post;
        $Ads = DB::table('advertisements')
            ->join('users', 'advertisements.UserID', '=', 'users.id')
            ->select('users.*')
            ->where([
                ['advertisements.id', $pos],
            ])
            ->paginate(3);
            dump($Ads);
        
        $categories = Categories::orderBy('id')->get();
        return view('user.buy', compact('title', 'Ads', 'categories'));
    }
}
