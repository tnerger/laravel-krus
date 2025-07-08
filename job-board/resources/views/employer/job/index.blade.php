<x-layout>
    <x-bread-crumbs :links="['My Jobs' => '#']" class="mb-4" />

    <div class="mb-8 text-right">
        <x-link-button href="{{ route('employer.job.create', $employer) }}">Add new</x-link-button>
    </div>
    @forelse ($jobs as $job)
        <x-job-card :$job>
            <div class="text-xs text-slate-500">
                @forelse ($job->jobApplications as $application)
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <div>{{ $application->user->name }}</div>
                            <div>Applied {{ $application->created_at->diffForHumans() }}</div>
                            <div>
                                Download CV
                            </div>
                        </div>
                        <div>
                            ${{number_format($application->expected_salary)}}
                        </div>
                    </div>
                @empty
                    <div>No Applications yet.</div>
                @endforelse
                <div class="flex space-x-2">
                    <x-link-button href="{{route('employer.job.edit', [$employer, $job])}}">Edit</x-link-button>
                    <form action="{{route('employer.job.destroy',[$employer, $job])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button>Delete</x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <x-card>No Jobs yet! Start now!</x-card>
    @endforelse
</x-layout>
