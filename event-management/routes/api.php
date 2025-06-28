<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Resource Controller erstellen nur die Ruten, die für eine API gebraucht werden
// sie verzichten dabei auf z.B. create, das für Formulare angewendet wird
Route::apiResource('events', EventController::class)
    ->only(['index', 'show']); // Events Public Routes

Route::apiResource('events', EventController::class)
    ->only(['store', 'update', 'destroy'])
    ->middleware(['auth:sanctum', 'throttle:api']); // Protected & Throttled Routes

// Scoped? Für Route Model Binding, damit das Event auch immer geladen wird.
// Denn ohne Event gibt es keinen Teilnehmenden
Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped() // Scoped ohne Parameter, weil das sonst Fehler wirft, denn Laravel erkennt die Relation auch so
    ->only(['store', 'destroy'])
    ->middleware(['auth:sanctum', 'throttle:api']); // Protected & Throttled

Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped()
    ->only(['index', 'show']); // Public Attendee Routes

Route::post('/login', [AuthController::class, 'login']);
