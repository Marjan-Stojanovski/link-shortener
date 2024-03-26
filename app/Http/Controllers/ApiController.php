<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function store(Request $request)
    {
        //Validate the input Url
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
        ]);

        //Return Bad request if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bad request/Url Not Valid',
            ], 400);
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

        //Return data and status
        if ($link) {
            //if success
            return response()->json([
                'status' => 'success',
                'message' => 'Url saved successfully',
                'data' => $link
            ], 200);
        } else {
            //if error
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Error',
            ], 500);
        }
    }
    public function view($short_url)
    {
        //Retrieve the record from DB
        $link = Link::where('short_url', $short_url)->first();

        if ($link) {
            //if exists add counter and return the link
            $newCounter = $link->counter +1;
            $link->counter = $newCounter;
            $link->save();

            return response()->json([
                'status' => 'success',
                'original_url' => $link->url
            ], 200);
        } else {
            //if doesn't exist send error
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found',
            ], 404);
        }
    }
}
