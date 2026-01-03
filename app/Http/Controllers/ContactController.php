<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function form()
    {
        return view('contact.form');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $msg = ContactMessage::create($validated);

        // mail goes to admin (MAIL_MAILER=log => check storage/logs/laravel.log)
        Mail::to('admin@ehb.be')->send(new ContactFormMail($msg));

        return back()->with('success', 'message sent');
    }
}
