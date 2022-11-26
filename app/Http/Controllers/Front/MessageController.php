<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        return view('Front.message.index');
}

    public function store (Request $request){
        $request->validate([
            'name'=>'required|string|max:32',
            'phone'=>'required|integer|min:61000000|max:65999999',
            'text'=>'required|string|max:500',]);
        $message = new Message();
        $message->name = $request->name;
        $message->phone = $request->phone;
        $message->text = $request->text;
        $success = trans('app.send-response');
        $message->save();

        return redirect()->back()
            ->with([
                'success' => $success,
            ]);
    }
}