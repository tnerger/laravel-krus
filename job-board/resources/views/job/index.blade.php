<x-layout>
    <x-bread-crumbs class="mb-4" :links="['Jobs' => '#']" />
    <x-card class="mb-4 text-sm">
        <form action="{{ route('jobs.index') }}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{request('search')}}" placeholder="Search for any Text" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{request('min_salary')}}" placeholder="From" />
                        <x-text-input name="max_salary" value="{{request('max_salary')}}" placeholder="To" />
                    </div>
                </div>
                <div>xxx</div>
                <div>xxx</div>

                <button type="submit" class="w-full" aria-label="Filter jobs">Filter</button>
            </div>
        </form>
    </x-card>
    @foreach ($jobs as $job)
        <x-job-card :$job>
            <div>
                <x-link-button :href="route('jobs.show', $job)">
                    Show
                </x-link-button>
            </div>
        </x-job-card>
    @endforeach
</x-layout>
