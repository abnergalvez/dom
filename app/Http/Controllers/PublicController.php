<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PublicController extends Controller
{
    public function searchMap(Request $request)
    {   	
    	//$client = new \GuzzleHttp\Client();
        //$res = $client->request('GET', 'http://209.97.156.75:3000/addresses/'.$request->address.'');
        //$json =  $res->getBody()->getContents();
        //dd($json);
    	return view('general_map');
    }

    public function ratingComment(Request $request)
    {
    	$comment = \App\Comment::create($request->all());
    	return redirect('/');
    }
}
