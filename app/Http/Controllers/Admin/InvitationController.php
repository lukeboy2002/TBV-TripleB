<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserInvitation;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    /**
     * Display a listing of the invitations.
     */
    public function index()
    {
        if (! auth()->user()->can('viewAny', Invitation::class)) {
            abort(403, 'You do not have access to this page.');
        }

        return view('invitations.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:invitations'],

        ]);

        $invitation = Invitation::create([
            'email' => $request['email'],
            'invited_by' => auth()->user()->id,
            'invited_date' => now(),
        ]);

        $invitation->generateInvitationToken();
        $invitation->save();

        $mailData = [
            'title' => 'U have a invitation from TripleB',
            'link' => $invitation->getLink(),
            'invited_by' => auth()->user()->username,
            'invited_date' => now(),
        ];

        Mail::to($request->get('email'))->send(new UserInvitation($mailData));

        return redirect()->route('admin.invitations.create')->with('success', 'Invitation to register successfully requested. A mail has been sent to '.$invitation->email);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->can('create', Invitation::class)) {
            abort(403, 'You do not have access to this page.');
        }

        return view('invitations.create');
    }

    /**
     * Remove the specified invitation from storage.
     */
    public function destroy(Invitation $invitation)
    {
        if (! auth()->user()->can('delete', $invitation)) {
            abort(403, 'You do not have permission to delete this invitation.');
        }

        $invitation->delete();

        return redirect()->back()->with('success', 'Invitation deleted successfully.');
    }
}
