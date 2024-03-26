<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        //Retrieve all records from DB and pass ti view
        $links = Link::all();

        $data = [
            'links' => $links
        ];
        return view('home')->with($data);
    }

    public function add_link()
    {
        //Go to add link view
        return view('add-link');
    }

    public function view($short_url)
    {
        //Retrieve the record from DB
        $link = Link::where('short_url', $short_url)->first();

        if ($link) {
            //if exists add counter and redirect to the link
            $newCounter = $link->counter + 1;

            $link->counter = $newCounter;
            $link->save();

            return redirect($link->url);

        } else {
            //if doesn't exist redirect to route with error
            Session::flash('flash_message', 'Url not found!');
            return redirect()->route('home.index');
        }
    }
}
