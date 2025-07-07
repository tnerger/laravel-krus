<x-layout>
    <x-bread-crumbs class="mb-4" :links="['Me' => '#', 'Job Applications' => '#']" />
    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex justify-between items-center text-xs text-slate-500">
                <div>
                    <div>Applied {{ $application->created_at->diffForHumans() }}</div>
                    <div>Other {{ Str::plural('Appliciant', $application->job->job_applications_count - 1) }}
                        {{ $application->job->job_applications_count - 1 }}</div>
                    <div>
                        Your asking salary is ${{ number_format($application->expected_salary) }}
                    </div>
                    <div>
                        AVG asking salary ${{ number_format($application->job->job_applications_avg_expected_salary) }}
                    </div>
                </div>
                <div>
                    <form action="{{ route('my-job-applications.destroy', $application) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button>Cancel</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <x-card>You hve not made any applications yet!</x-card>
    @endforelse

</x-layout>
