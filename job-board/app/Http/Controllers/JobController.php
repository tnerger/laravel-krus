<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // To-Do Parameter-Validierung
        $jobs = Job::query();

        $jobs
        ->when(request('search'), function($query){
            $query->where(function($query){
                // Die Verschaltelung hier findet statt
                // Um die Suche in Title und Description
                // in Klammern zu fassen
                // dann ist die Query: select * from `jobs` where (`title` like '%manager%' or `description` like '%manager%') and `salary` >= '10000' and `salary` <= '20000'
                // statt : select * from `jobs` where `title` like '%manager%' or `description` like '%manager%' and `salary` >= '10000' and `salary` <= '20000'
                $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        })
        ->when(request('min_salary'), function($query){
            $query->where('salary','>=', request('min_salary') );
        })
        ->when(request('max_salary'), function($query){
            $query->where('salary','<=', request('max_salary') );
        });

        return view('job.index', ['jobs' => $jobs->get()]);
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
    public function show(Job $job)
    {
        return view('job.show', ['job' => $job]);
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
