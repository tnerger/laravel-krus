<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobApplicationController extends Controller
{

    public function create(Job $job)
    {
        Gate::authorize('apply', $job);
        // Im Kurs ist es job_application, das sieht aber wirklich cniht schön aus...
        return view('job.application.create', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {
        Gate::authorize('apply', $job);
        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            ...$request->validate([
                'expected_salary' => 'required|min:1|max:1000000'
            ])
        ]);
        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job Application submitted.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
