<x-layout>
    <x-bread-crumbs class="mb-4" :links="['Jobs' => '#']" />
    <x-card class="mb-4 text-sm" x-data="{}">
        <form x-ref="filters" action="{{ route('jobs.index') }}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}" form-ref="filters" placeholder="Search for any Text" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" form-ref="filters" placeholder="From" />
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" form-ref="filters" placeholder="To" />
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    {{--
                    Komische Kurs Option:
                    :options="array_combine(
                        array_map('ucfirst', App\Models\Job::$experience),
                        App\Models\Job::$experience,
                    )"
                    I mog aber array_reduce lieber :-)
                    --}}
                    <x-radio-group name="experience" :options="array_reduce(
                        App\Models\Job::$expierience,
                        function($carry, $item) {$carry[ucfirst($item)] = $item; return $carry;},
                        []
                    )" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category" :options="App\Models\Job::$category" />
                </div>

                <x-button type="submit" class="col-span-2" aria-label="Filter jobs">Filter</x-button>
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
