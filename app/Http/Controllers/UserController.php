<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Get user's activities for timeline
        $activities = collect();

        // Add posts to activities
        $posts = $user->posts()->latest()->get();
        foreach ($posts as $post) {
            $activities->push([
                'type' => 'post',
                'model' => $post,
                'date' => $post->created_at,
                'message' => 'created a new post: '.$post->title,
            ]);
        }

        // Add albums to activities
        $albums = $user->albums()->latest()->get();
        foreach ($albums as $album) {
            $activities->push([
                'type' => 'album',
                'model' => $album,
                'date' => $album->created_at,
                'message' => 'created a new Album',
            ]);
        }

        // Add comments to activities
        $comments = $user->comments()->latest()->get();
        foreach ($comments as $comment) {
            $activities->push([
                'type' => 'comment',
                'model' => $comment,
                'date' => $comment->created_at,
                'message' => 'commented on a post: '.$comment->post->title,
            ]);
        }

        // Add likes to activities
        $likes = $user->likes()->latest()->get();
        foreach ($likes as $like) {
            $likeableType = class_basename($like->likeable_type);
            $message = 'liked a ';

            if ($likeableType === 'Post') {
                $message .= 'post: '.$like->likeable->title;
            } elseif ($likeableType === 'Comment') {
                $message .= 'comment on: '.$like->likeable->post->title;
            } else {
                $message .= strtolower($likeableType);
            }

            $activities->push([
                'type' => 'like',
                'model' => $like,
                'date' => $like->created_at,
                'message' => $message,
            ]);
        }

        // Add invitations to activities
        $invitations = $user->invitee()->latest()->get();
        foreach ($invitations as $invitation) {
            $activities->push([
                'type' => 'invitation',
                'model' => $invitation,
                'date' => $invitation->invited_date,
                'message' => 'invited '.$invitation->email.' to join',
            ]);
        }

        // Add profile updates to activities
        if ($user->profile) {
            $activities->push([
                'type' => 'profile_update',
                'model' => $user->profile,
                'date' => $user->profile->updated_at,
                'message' => 'updated their profile information',
            ]);
        }

        // Add user model updates to activities
        $activities->push([
            'type' => 'user_update',
            'model' => $user,
            'date' => $user->updated_at,
            'message' => 'updated their account information',
        ]);

        // Sort activities by date (newest first) and limit to 10 items
        $activities = $activities->sortByDesc('date')->take(6)->values();

        // Get statistics
        $stats = [
            'posts' => $posts->count(),
            'albums' => $albums->count(),
            'comments' => $comments->count(),
            'likes' => $likes->count(),
            'invitations' => $invitations->count(),
            'followers' => $user->followers()->count(),
            'following' => $user->following()->count(),
        ];

        return view('profile.user', [
            'user' => $user,
            'activities' => $activities,
            'stats' => $stats,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function follow(Request $request, User $user)
    {
        // Check if the authenticated user is trying to follow themselves
        if ($request->user()->id === $user->id) {
            return redirect()->back()->with('error', 'You cannot follow yourself.');
        }

        // Check if the authenticated user is already following the user
        if ($request->user()->isFollowing($user)) {
            return redirect()->back()->with('info', 'You are already following this user.');
        }

        // Follow the user
        $request->user()->following()->attach($user->id);

        return redirect()->back()->with('success', 'You are now following '.$user->username.'.');
    }

    /**
     * Unfollow a user.
     */
    public function unfollow(Request $request, User $user)
    {
        // Check if the authenticated user is trying to unfollow themselves
        if ($request->user()->id === $user->id) {
            return redirect()->back()->with('error', 'You cannot unfollow yourself.');
        }

        // Check if the authenticated user is not following the user
        if (! $request->user()->isFollowing($user)) {
            return redirect()->back()->with('info', 'You are not following this user.');
        }

        // Unfollow the user
        $request->user()->following()->detach($user->id);

        return redirect()->back()->with('success', 'You have unfollowed '.$user->username.'.');
    }
}
