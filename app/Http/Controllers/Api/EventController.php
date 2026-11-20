<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AttendanceRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\EventAttendance;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EventController extends Controller
{
    /**
     * Komende events (vanaf vandaag), eerstvolgende eerst.
     */
    public function index(): AnonymousResourceCollection
    {
        $events = Event::with(['user.profile', 'attendances'])
            ->where('date', '>=', now()->startOfDay())
            ->orderBy('date')
            ->paginate(10);

        return EventResource::collection($events);
    }

    public function show(Event $event): EventResource
    {
        return new EventResource($event->load(['user.profile', 'attendances.user.profile']));
    }

    /**
     * Je eigen aanmelding zetten: attending, maybe of not_attending.
     */
    public function attendance(AttendanceRequest $request, Event $event): EventResource
    {
        EventAttendance::updateOrCreate(
            ['event_id' => $event->id, 'user_id' => $request->user()->id],
            ['status' => $request->string('status')->toString()],
        );

        return new EventResource($event->load(['user.profile', 'attendances.user.profile']));
    }
}
