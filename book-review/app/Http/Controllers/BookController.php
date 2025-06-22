<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = request('filter', '');

        $books = Book::when($title, function ($query, $title) {
            return $query->title($title);
        });
        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Month(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Month(),
            default => $books->latest()->withAvgRating()->withReviewsCount(),
        };
        // $books = $books->get();

        $books =
            Cache::remember(
                'books' . md5(http_build_query(request()->query())),
                3600,
                fn() =>
                $books->paginate(10)
            );

        return view('books.index', ['books' => $books]);
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
    public function show(int $id)
    {
        $cacheKey = 'book2:' . $id . ':' . md5(http_build_query(request()->except('page')));

        // Caching nur fürs Buch, nicht für paginierte Daten
        $book = cache()->remember(
            $cacheKey,
            3600,
            fn() => Book::withAvgRating()->withReviewsCount()->findOrFail($id)
        );

        // Reviews separat, da sie request()->page abhängig sind
        $reviews = $book->reviews()
            ->popular()
            ->latest()
            ->paginate(10)
            ->appends(request()->query());

        return view('books.show', compact('book', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
