<?php

namespace App\Http\Controllers;


use App\Mail\ContactForm;
use App\Mail\ContactFormReply;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'min:10'],
        ]);

        Contact::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'subject' => $request['subject'],
            'message' => $request['message'],
            'ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
        ]);

        $mailData = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ipaddress' => request()->getClientIp(),
            'time' => now()
        ];

        Mail::to('info@tbv-tripleb.nl')->send(new ContactForm($mailData));
        Mail::to($request->get('email'))->send(new ContactFormReply($mailData));

        toastr()->success('Message successfully send.', 'Send Message');
        return redirect()->route('contact');
    }
}
