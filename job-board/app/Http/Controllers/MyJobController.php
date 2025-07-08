<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Employer $employer)
    {
        Gate::authorize('viewAnyEmployer', Job::class);
        return view('employer.job.index', [
            'employer' => $employer,
            'jobs' => $employer->jobs()->with(['employer', 'jobApplications.user'])->withTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employer $employer)
    {
        Gate::authorize('create', Job::class);

        return view('employer.job.create', ['employer' => $employer]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request, Employer $employer)
    {

        Gate::authorize('create', Job::class);

        $employer->jobs()->create($request->validated());

        return redirect()->route('employer.job.index', $employer)
            ->with('success', 'Job created!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer, Job $job)
    {
        Gate::authorize('update', $job);
        return view('employer.job.edit', ['employer' => $employer, 'job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Employer $employer, Job $job)
    {
        Gate::authorize('update', $job);
        $job->update($request->validated());

        return redirect()->route('employer.job.index', $employer)
            ->with('success', 'Job updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer, Job $job)
    {
        $job->delete();

        return redirect()->route('employer.job.index', $employer)
            ->with('success', 'Job deleted');
    }
}
