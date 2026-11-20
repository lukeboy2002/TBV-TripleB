<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Event
 */
class EventResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $myAttendance = $this->relationLoaded('attendances')
            ? $this->attendances->firstWhere('user_id', $request->user()?->id)
            : null;

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->when($request->routeIs('api.events.show'), $this->body),
            'date' => $this->date?->toIso8601String(),
            'end_date' => $this->end_date?->toIso8601String(),
            'image_url' => $this->image_path ? asset('storage/'.$this->image_path) : null,
            'organizer' => new PlayerResource($this->whenLoaded('user')),
            'my_status' => $myAttendance?->status,
            'counts' => $this->whenLoaded('attendances', fn () => [
                'attending' => $this->attendances->where('status', 'attending')->count(),
                'maybe' => $this->attendances->where('status', 'maybe')->count(),
                'not_attending' => $this->attendances->where('status', 'not_attending')->count(),
            ]),
            'attendees' => $this->when(
                $request->routeIs('api.events.show') && $this->relationLoaded('attendances'),
                fn () => $this->attendances->map(fn ($attendance) => [
                    'player' => new PlayerResource($attendance->user),
                    'status' => $attendance->status,
                ])->values()
            ),
        ];
    }
}
