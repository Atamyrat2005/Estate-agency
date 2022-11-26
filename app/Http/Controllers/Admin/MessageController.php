<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer|min:1',
            'name'=>'nullable|string|max:32',
            'phone'=>'nullable|integer|min:61000000|max:65999999',
            'text'=>'nullable|string|max:500',
            'created_at' => 'nullable|string|max:10',
            ]);
        $f_id = $request->id ?: null;
        $f_name = $request->name ?: null;
        $f_phone = $request->phone ?: null;
        $f_text = $request->text ?: null;
        $f_createdAt = $request->created_at ?: null;

        $messages = Message::when($f_id, function ($query, $f_id) {
            return $query->where('id', 'like', '%' . $f_id . '%');
        })
            ->when($f_name, function ($query, $f_name) {
                return $query->where('name', 'like', '%' . $f_name . '%');
            })
            ->when($f_phone, function ($query, $f_phone) {
                return $query->where('phone', 'like', '%' . $f_phone . '%');
            })
            ->when($f_text, function ($query, $f_text) {
                return $query->where('text', 'like', '%' . $f_text . '%');
            })
            ->when($f_createdAt, function ($query, $f_createdAt) {
                return $query->where('created_at', 'like', '%' . $f_createdAt . '%');
            })
            ->orderBy('id')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('Admin.messages.index', [
            'f_id' => $f_id,
            'f_name' => $f_name,
            'f_phone' => $f_phone,
            'f_text' => $f_text,
            'f_createdAt' => $f_createdAt,
            'messages' => $messages,
        ]);
    }

    public function delete($id)
    {
        $message = Message::where('id', $id)
            ->firstOrFail();
        $success = trans('app.delete-response', ['name' => $message->name]);
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with([
                'success' => $success,
            ]);
    }
}
