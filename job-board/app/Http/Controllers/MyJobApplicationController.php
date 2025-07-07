<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.applications.index',[
            'applications' => auth()
            ->user()
            ->jobApplications() // Wegen Relation, die im User-Modell beschrieben ist
            ->with(['job' => fn($query) => $query->withCount('jobApplications')->withAvg('jobApplications', 'expected_salary'),'job.employer']) // Direkt den Job für Infos mitladen
            ->latest()->get() // Und alles abholen :-)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * Wichtig zu wissen: Beim "Route Model Binding":
     * ROUTE:  DELETE     my-job-applications/{my_job_application}
     * Da muss dann die Variable heißen wie das zwischen den Klammern!
     * Also: {my_job_application} => $myJobApplication
    */
    public function destroy(JobApplication $myJobApplication)
    {
        // dd($myJobApplication);
        $myJobApplication->delete();
        return redirect()->back()->with(
            'success',
            'Job Application canceled'
        );
    }
}
