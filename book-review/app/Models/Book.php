<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeTitle(Builder $query, string $title): Builder
    {
        // wird aufgerufen $book::title('delectus')
        /*
        Illuminate\Database\Eloquent\Collection {#1308
            all: [
            App\Models\Book {#6192
                id: 25,
                title: "Et repellendus delectus repudiandae.",
                author: "Kiana Heaney",
                created_at: "2024-09-19 04:55:44",
                updated_at: "1993-01-24 19:58:18",
            },
            ],
        }
        */
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withCount(
            [
                'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ]
        );
    }

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query->withAvg(
            [
                'reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
            ],
            'rating'
        );
    }

    public function scopePopular(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query
            ->withReviewsCount()
            ->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder|QueryBuilder
    {
        return $query
            ->withAvgRating()
            ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinRewviews(Builder $query, int $minReviews): Builder|QuerybUilder
    {
        return $query->having('reviews_count', '>=', $minReviews);
    }

    private function dateRangeFilter(Builder $query, $from, $to)
    {
        if ($from && !$to) {
            $query->where('created_at', '>=', $from);
        } else if (!$from && $to) {
            $query->where('created_at', '<=', $to);
        } else if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopePopularLastMonth(Builder $query): Builder|QueryBuilder
    {
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->MinRewviews(2);
    }

    public function scopePopularLast6Month(Builder $query): Builder|QueryBuilder
    {
        return $query->popular(now()->subMonth(6), now())
            ->highestRated(now()->subMonth(6), now())
            ->MinRewviews(5);
    }

    public function scopeHighestRatedLastMonth(Builder $query): Builder|QueryBuilder
    {
        return $query->highestRated(now()->subMonth(), now())
            ->popular(now()->subMonth(), now())
            ->MinRewviews(2);
    }

    public function scopeHighestRatedLast6Month(Builder $query): Builder|QueryBuilder
    {
        return $query->highestRated(now()->subMonth(6), now())
            ->popular(now()->subMonth(6), now())
            ->MinRewviews(5);
    }

    protected static function booted() {
        static::updated(fn(Book $book) => cache()->forget('book2:' . $book->id));
        static::deleted(fn(Book $book) => cache()->forget('book2:' . $book->id));
    }
}
