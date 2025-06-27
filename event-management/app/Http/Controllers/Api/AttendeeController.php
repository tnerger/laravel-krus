<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $attendees = $event->attendees()->latest();

        return AttendeeResource::collection(
            $attendees->paginate() // das mit der Pginierung funktioniert auch in der API
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        // Relationship Model "event->attendees()->create" um den Attendee direkt mit dem Parent "Event"
        // zu verbiden
        $attendee = $event->attendees()->create([
            'user_id' => 1
        ]);

        return new AttendeeResource($attendee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // Event ist hier ein Strinf, weil wir das nicht brauchen um den Attendee
    // zu löschen, so sparen wir uns den Zugriff auf die DB
        public function destroy(string $event, Attendee $attendee)
    {
        $attendee->delete();

        return response(status: 204);
    }
}
