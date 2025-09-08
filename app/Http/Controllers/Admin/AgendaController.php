<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        if (! auth()->user()->can('update', $agenda)) {
            abort(403, 'You do not have access to this page.');
        }

        $categories = Category::all();

        return view('agenda.edit', [
            'agenda' => $agenda,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        if (! auth()->user()->can('update', $agenda)) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'min:10'],
            'date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:date'],
            'private' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $imageChanged = true;
            if ($agenda->image) {
                Storage::delete($agenda->image);
            }
            $path = $request->file('image')->store('agendas', 'public');
            $agenda->image = $path;
        }

        $slug = SlugService::createSlug(Agenda::class, 'slug', $request->name);

        $agenda->update([
            'user_id' => auth()->user()->id,
            'name' => $request['name'],
            'slug' => $slug,
            'image' => isset($newFilename) ? "agendas/$newFilename" : $agenda->image,
            'description' => $request['description'],
            'date' => $request['date'],
            'end_date' => $request['end_date'] ?? null,
            'private' => $request->boolean('private'),
        ]);

        flash()->success('Event successfully updated.');

        return redirect()->route('agenda.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('create:event')) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'min:10'],
            'date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:date'],
            'private' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('agendas', 'public');
        }

        $slug = SlugService::createSlug(Agenda::class, 'slug', $request->name);

        Agenda::create([
            'user_id' => auth()->user()->id,
            'name' => $request['name'],
            'slug' => $slug,
            'image' => $path,
            'description' => $request['description'],
            'date' => $request['date'],
            'end_date' => $request['end_date'] ?? null,
            'private' => $request->boolean('private'), // dit geeft false als niet aanwezig
        ]);

        //        // Send notification to all users with the 'member' role
        //        $members = User::role('member')->get();
        //        foreach ($members as $member) {
        //            Mail::to($member->email)->send(new NewEvent($agenda, Auth::user()->username));
        //        }

        flash()->success('Event successfully created.');

        return redirect()->route('agenda.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->can('create:event')) {
            abort(403, 'You do not have access to this page.');
        }

        return view('agenda.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        //
    }

    //    public function upload(Request $request)
    //    {
    //        try {
    //            if (! $request->hasFile('upload')) {
    //                return response()->json([
    //                    'uploaded' => 0,
    //                    'error' => [
    //                        'message' => 'No file uploaded.',
    //                    ],
    //                ]);
    //            }
    //
    //            $event = new Agenda;
    //            $event->id = 0;
    //            $event->exists = true;
    //
    //            // Store on the public disk explicitly to ensure URL accessibility in production
    //            $image = $event->addMediaFromRequest('upload')->toMediaCollection('agendas', 'public');
    //
    //            return response()->json([
    //                'uploaded' => 1,
    //                'fileName' => $image->file_name,
    //                'url' => $image->getUrl(),
    //            ]);
    //        } catch (Exception $e) {
    //            return response()->json([
    //                'uploaded' => 0,
    //                'error' => [
    //                    'message' => $e->getMessage(),
    //                ],
    //            ]);
    //        }
    //    }
    public function upload(Request $request)
    {
        try {
            if (! $request->hasFile('upload')) {
                return response()->json([
                    'uploaded' => 0,
                    'error' => ['message' => 'No file uploaded.'],
                ]);
            }

            $path = $request->file('upload')->store('ckeditor', 'public');

            return response()->json([
                'uploaded' => 1,
                'fileName' => basename($path),
                'url' => asset('storage/'.$path),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => $e->getMessage()],
            ]);
        }
    }
}
