<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Advertisements;
use App\Models\Categories;

class MainController extends Controller
{
    public function index()
    {
        $title = 'Main';
        $users = User::orderBy('id')->get();
        return view('admin.main', compact('users', 'title'));
    }

    public function delete(Request $request)
    {
        $p = $request->post;
        $post = Advertisements::find($p);
        $post->delete();
        return redirect()->route('home')->with('success', 'Удаление поста прошло успешно');
        
    }

    public function redac(Request $request)
    {
        $rp = $request->post;
        $title = 'Redaction Page';
        $categories = Categories::pluck('CategoryName', 'id')->all();
        $cats = Categories::orderBy('id')->get();
        $old = Advertisements::find($rp);
        return view('admin/redaction', compact('title', 'categories', 'rp', 'old', 'cats'));
    }

    public function redac2(Request $request)
    {
        $this->validate(
            $request,
            [
                // 'CategoryID' => 'required|integer',
                // 'Title' => 'required|min:5|max:100',
                // 'Description' => 'required',
                // 'AdPhoto' => 'required|image',
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
        } else {
            $AdPhoto = $request->ph;
        }
        Advertisements::where("id", $request->id)->update([
            'UserID' => $request->uid,
            'CategoryID' => $request->CategoryID,
            'Title' => $request->Title,
            'Description' => $request->Description,
            'AdPhoto' => $AdPhoto,
            'Status' => 'Ex'
        ]);
        return redirect()->route('home');
    }

    public function nposts(Request $request)
    {
        $cat = $request->Cat;
        $title = 'Home page';
        $categories = Categories::orderBy('id')->get();
        $Ads = Advertisements::orderBy('id', 'desc')->where('Status', 'Ex')->paginate(3);

        return view('admin/nposts', compact('title', 'Ads', 'categories', 'cat'));
    }

    public function opub(Request $request)
    {
        $np = $request->post;
        Advertisements::where("id", $np)->update([
            'Status' => 'Y'
        ]);
        return redirect()->route('home')->with('success', 'Добаление поста прошло успешно');
    }

    public function ban(Request $request)
    {
        $u = $request->us;
        User::where("id", $u)->update([
            'Role' => '2'
        ]);
        $title = 'Main';
        $users = User::orderBy('id')->get();
        // return view('admin.main', compact('users', 'title'))->with('success', 'Пользователь забанен');
        return redirect()->route('main.index', compact('users', 'title'))->with('success', 'Пользователь забанен');
    }

    public function rasban(Request $request)
    {
        $u = $request->us;
        User::where("id", $u)->update([
            'Role' => '0'
        ]);
        $title = 'Main';
        $users = User::orderBy('id')->get();
        return redirect()->route('main.index', compact('users', 'title'))->with('success', 'Пользователь разбанен');
    }

    public function ncat(Request $request)
    {
        $cat = $request->Cat;
        $title = 'Home page';

        $categories = Categories::orderBy('id')->get();
        $Ads = Advertisements::orderBy('id', 'desc')->where('Status', 'Ex')->paginate(3);
        return view('admin/ncat', compact('title', 'Ads', 'categories', 'cat'));
    }

    public function ncatt(Request $request)
    {
        $this->validate(
            $request,
            [
                'ncat' => 'required',
            ],
            [
                'ncat.required' => 'Заполните поле Категория',
            ]
        );
        Categories::create([
            'CategoryName' => $request->ncat,
        ]);
        return redirect()->route('home');
    }
}
