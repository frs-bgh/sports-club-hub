<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;

class AdminContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderByDesc('id')->paginate(20);

        return view('admin.contacts.index', [
            'messages' => $messages,
        ]);
    }

    public function show(ContactMessage $contactMessage)
    {
        return view('admin.contacts.show', [
            'message' => $contactMessage,
        ]);
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return back()->with('success', 'message deleted');
    }
}
