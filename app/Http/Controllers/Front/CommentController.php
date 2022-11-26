<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
        public function create(){
        return view('Front.comment');
    }

        public function store (Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required|integer|max:8',
            'message'=>'required|string|max:250',]);
        $comment = new Comment();
        $comment->name = $request->name;
        $comment->phone = $request->phone;
        $comment->message = $request->message;
        $comment->save();

        return redirect()->back()->with(['success'=>'success']);
    }
}