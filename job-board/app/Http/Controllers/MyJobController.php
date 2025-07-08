<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Employer $employer)
    {

        return view('employer.job.index', [
            'employer' => $employer,
            'jobs' => $employer->jobs()->with(['employer', 'jobApplications.user'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employer $employer)
    {
        return view('employer.job.create', ['employer' => $employer]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request, Employer $employer)
    {


        $employer->jobs()->create($request->validated());

        return redirect()->route('employer.job.index', $employer)
            ->with('success', 'Job created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer, Job $job)
    {
        return view('employer.job.edit', ['employer' => $employer, 'job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request,Employer $employer, Job $job)
    {

        $job->update($request->validated());

        return redirect()->route('employer.job.index', $employer)
            ->with('success', 'Job updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
