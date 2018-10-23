<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function searchMap(Request $request)
    {
    	return view('general_map');
    }

    public function ratingComment(Request $request)
    {
    	$comment = \App\Comment::create($request->all());
    	return redirect('/');
    }
}
