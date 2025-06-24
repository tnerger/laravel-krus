<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Resource Controller erstellen nur die Ruten, die für eine API gebraucht werden
// sie verzichten dabei auf z.B. create, das für Formulare angewendet wird
Route::apiResource('events', EventController::class);

// Scoped? Für Route Model Binding, damit das Event auch immer geladen wird.
// Denn ohne Event gibt es keinen Teilnehmenden
Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped(['attendee' => 'event']);
