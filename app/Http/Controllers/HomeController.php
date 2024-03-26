<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $links = Link::all();

        $data = [
            'links' => $links
        ];
        return view('home')->with($data);
    }

    public function add_link()
    {
        return view('add-link');
    }

    public function view($short_url)
    {
        $link = Link::where('short_url', $short_url)->first();

        if ($link) {
            $newCounter = $link->counter +1;

            $link->counter = $newCounter;
            $link->save();

            return redirect($link->url);

        } else {

            Session::flash('flash_message', 'Url not found!');
            return redirect()->route('home.index');

        }
    }
}
