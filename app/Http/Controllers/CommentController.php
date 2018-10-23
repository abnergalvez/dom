<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        return view('comments.index')->with('comments', Comment::all());
    }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

  
    public function show(Comment $comment)
    {
        //
    }

   
    public function edit(Comment $comment)
    {
        //
    }

   
    public function update(Request $request, Comment $comment)
    {
        //
    }

   
    public function destroy(Comment $comment)
    {
        //
    }
}
