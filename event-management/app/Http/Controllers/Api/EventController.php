<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Querybuilder starten
        $query = Event::query();
        // Relationen definieren, die möglich sein sollen
        $relations = ['user', 'attendees', 'attendees.user'];

        // durch relationen iterieren
        foreach ($relations as $relation) {
            // Queribuilder WHEN nutzen um
            // die Relationenn zu laden, wenn sie erwünscht sind.
            // Dazu die eigene Funktion nutzen
            $query->when(
                $this->shouldIncludeRealtion($relation), // wenn true
                fn($q) => $q->with($relation) // dann relation laden
            );
        }

        return EventResource::collection(
            $query->latest()->paginate() // query für die Ausgabe nutzen
        );
    }

    protected function shouldIncludeRealtion(string $relation): bool
    {
        $include = request()->query('include'); // Query Parameter aus der Reqauest Funcktion holen

        if (!$include) { // wenn es die nicht gibt, dann immer false returnen
            return false;
        }

        $realations = array_map('trim', explode(',', $include)); // wenn es Includes gibt, exploden und werte mit array_map trimmen

        return in_array($relation, $realations); // bool zurückgeben in dem man prüft, ob der String $relation in dem Array $relations vorhanden ist
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $event = Event::create([
            ...$request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time'
            ]),
            'user_id' => 1
        ]);

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('user');
        $event->load('attendees');
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update([
            // sometimes => Bedeutet, dass der Rest der Validierungen danach nur geprüft wird,
            // wenn das Wertepaar auch mit übergeben wird.
            ...$request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time'
            ])
        ]);
        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([
            'message' => 'Event deleted successfully'
        ]);
    }
}
