<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

trait CanLoadRelationships
{
    public function loadRelationships(
        Model|EloquentBuilder|Builder|HasMany $for,
        ?array $relations = null
    ): Model|EloquentBuilder|Builder|HasMany {

        $relations = $relations // entweder die Relationen aus dem Array des Konstruktors
            ?? $this->relations // Oder die Relationen direkt aus dem Objekt, muss dann aber mit private $relations im z.B. Controller geladen werden
            ?? []; // Oder, als Fllback ein leeres Array.

        // durch relationen iterieren
        foreach ($relations as $relation) {
            // Queribuilder WHEN nutzen um
            // die Relationenn zu laden, wenn sie erwünscht sind.
            // Dazu die eigene Funktion nutzen
            $for->when(
                $this->shouldIncludeRealtion($relation), // wenn true
                fn($q) => $for instanceof Model ?  $for->load($relation) : $q->with($relation) // dann relation laden
            );
        }

        return $for;
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
}
