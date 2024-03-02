<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Mail\Contact_with_TripleB;
use App\Mail\ContacttoUser;
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

        $mailData = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ipaddress' => request()->getClientIp(),
            'time' => now()
        ];

        Mail::to('info@tbv-tripleb.nl')->send(new Contact($mailData));
        Mail::to($request->get('email'))->send(new Contact_with_TripleB($mailData));

        toastr()->success('Message successfully send.', 'Send Message');
        return redirect()->route('contact');
    }
}
