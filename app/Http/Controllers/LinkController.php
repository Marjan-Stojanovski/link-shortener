<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        do {
            $short_url = Str::random(5);
            $temp_url = Link::where('short_url', $short_url)->get();
        } while (!isset($temp_url));


        $link = Link::create([
            'url' => $request->get('url'),
            'short_url' => $short_url,
            'counter' => 0,
        ]);

        if ($link) {
            Session::flash('flash_message', 'Url successfully added!');
            return redirect()->route('home.index');
        } else {
            Session::flash('flash_message', 'Error, try again!');
            return redirect()->back();
        }
    }
}
