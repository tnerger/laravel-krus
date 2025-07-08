<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory, SoftDeletes;
    public $fillable = ['title', 'location', 'salary', 'description', 'experience', 'category'];
    public static array $experience = ['entry', 'intermediate', 'senior'];
    public static array $category = [
        'IT',
        'Finance',
        'Sales',
        'Marketing'
    ];


    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApllied(Authenticatable|User|int $user): bool
    {
        return $this->where('id', $this->id)
        ->whereHas(
            'jobApplications',
            fn($query) => $query->where('user_id', '=', $user->id ?? $user )
        )->exists();
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filters): Builder|QueryBuilder
    {

        $query
            ->when(
                $filters['search'] ?? null,
                // Erster Param hier: Builder,
                // Zweiter ist der in When geprüfte Wert
                function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        // Die Verschaltelung hier findet statt
                        // Um die Suche in Title und Description
                        // in Klammern zu fassen
                        // dann ist die Query: select * from `jobs` where (`title` like '%manager%' or `description` like '%manager%') and `salary` >= '10000' and `salary` <= '20000'
                        // statt : select * from `jobs` where `title` like '%manager%' or `description` like '%manager%' and `salary` >= '10000' and `salary` <= '20000'
                        $query
                            ->where('title', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%')
                            // Filtern über eine Beziehung immer mit xWhereHas
                            ->orWhereHas('employer', function ($query) use ($search) {
                                $query->where('company_name', 'like', '%' . $search . '%');
                            });
                    });
                }
            )
            ->when($filters['min_salary'] ?? null, function ($query, $min_salary) {
                $query->where('salary', '>=', $min_salary);
            })
            ->when($filters['max_salary'] ?? null, function ($query, $max_salary) {
                $query->where('salary', '<=', $max_salary);
            })
            ->when($filters['experience'] ?? null, function ($query, $experience) {
                $query->where('experience', $experience);
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            });

        return $query;
    }
}
