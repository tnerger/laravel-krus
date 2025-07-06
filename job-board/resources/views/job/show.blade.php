<x-layout>
    <x-bread-crumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-job-card :$job>
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!}
        </p>

        {{--
        @can ist ziemlich genail, dammit kann man prüfen oder User etwas dürfte.
        Wie z.B. hier in der JobPolicy ist geregelt, dass man sich nur einmal
        Beweerben darf. Das wird hier genutzt um den Button auszublenden.
         --}}
        @can('apply', $job)
            <x-link-button :href="route('job.application.create', $job)">Apply</x-link-button>
        @else
            <div class="text-center text-sm font-medium text-slate-500">
                You already applied to this job
            </div>
        @endcan
    </x-job-card>
    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More Jobs from "{{ $job->employer->company_name }}" for you:
        </h2>

        <div class="text-sm text-slate-500">
            @foreach ($job->employer->jobs as $otherJob)
                <div class="flex mb-4 justify-between">
                    <div>
                        <div class="text-slate-700">
                            <a href="{{ route('jobs.show', $otherJob) }}">{{ $otherJob->title }}</a>
                        </div>
                        <div class="text-xs">
                            {{ $otherJob->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="text-xs">${{ number_format($otherJob->salary) }}</div>
                </div>
            @endforeach
        </div>
    </x-card>
</x-layout>
