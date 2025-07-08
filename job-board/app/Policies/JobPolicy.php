<?php

namespace App\Policies;

use App\Models\User;
use App\Models\job;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function viewAnyEmployer(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, job $jobs): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return null !== $user->employer;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, job $job): bool|Response
    {
        if($user->employer->id !== $job->employer_id) {
            return false;
        }

        if($job->jobApplications()->count() > 0) {
            return Response::deny('Cannot change the job with applications');
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, job $job): bool
    {
        return $user->employer->id === $job->employer_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, job $job): bool
    {
        return $user->employer->id === $job->employer_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, job $job): bool
    {
        return $user->employer->id === $job->employer_id;
    }

    public function apply(User $user, Job $job): bool
    {
        return !$job->hasUserApllied($user);
    }
}
