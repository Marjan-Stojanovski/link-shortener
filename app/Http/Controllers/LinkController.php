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
        //Validate the input Url
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        //Return error if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //Generate unique 5-letter string
        do {
            $short_url = Str::random(5);
            $temp_url = Link::where('short_url', $short_url)->get();
        } while (!isset($temp_url));


        //Create DB record for the Url
        $link = Link::create([
            'url' => $request->get('url'),
            'short_url' => $short_url,
            'counter' => 0,
        ]);

        //Redirect with message
        if ($link) {
            //OK
            Session::flash('flash_message', 'Url successfully added!');
            return redirect()->route('home.index');
        } else {
            //NOK
            Session::flash('flash_message', 'Error, try again!');
            return redirect()->back();
        }
    }
}
