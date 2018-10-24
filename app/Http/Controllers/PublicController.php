<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PublicController extends Controller
{
    public function searchMap(Request $request)
    {   	
    	if($request->place == 'welcome'){
    		$client = new Client([
    			'base_uri' => 'http://209.97.156.75:3000'
    		]);
	    	$res = $client->get('/addresses/' . urlencode($request->address), ['http_errors' => false]);
	        $json =  json_decode($res->getBody()->getContents());
	       	if($res->getStatusCode() == "404"){
	       		return redirect()->back()->with('message', 'Dirección no encontrada');
	       	}
	       	else{
				return view('general_map')->with('prc_y_punto', json_encode($json->response));
	       	}
    	}
       	if($request->place == 'map'){
       		$client = new Client(['base_uri' => 'http://209.97.156.75:3000']);
	    	$res = $client->get('/addresses/' . urlencode($request->address), ['http_errors' => false]);
	        $json =  json_decode($res->getBody()->getContents());
	       	if($res->getStatusCode() == "404"){
	       		return view('general_map')->with('message', 'Dirección no encontrada');
	       	}
	       	else{
				return view('general_map')->with('prc_y_punto', json_encode($json->response));
	       	}
       	}
    }

    public function ratingComment(Request $request)
    {
    	$comment = \App\Comment::create($request->all());
    	return redirect('/');
    }
}
