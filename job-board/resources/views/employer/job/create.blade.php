<x-layout>
    <x-bread-crumbs :links="['My Jobs' => route('employer.job.index', $employer), 'Create' => '#']" class="mb-4" />
    <x-card class="mb_8">
        <form action="{{ route('employer.job.store', $employer) }}" method="POST">
            @csrf
            <div class="grid mb-4 grid-cols-2 gap-4">
                <div class="col-span-2">
                    <x-label for="title" :required="true">Job Title</x-label>
                    <x-text-input name="title" />
                </div>

                <div>
                    <x-label for="location" :required="true">Job Location</x-label>
                    <x-text-input name="location" />
                </div>

                <div>
                    <x-label for="salary" :required="true">Job Salary</x-label>
                    <x-text-input type="number" name="salary" />
                </div>

                <div class="col-span-2">
                    <x-label for="description" :required="true">Description</x-label>
                    <x-text-input type="textarea" name="description" />
                </div>

                <div>
                    <x-label for="experience" :required="true">Experience</x-label>
                    <x-radio-group name="experience" :allOption="false" :value="old('experience')" :options="array_reduce(
                        \App\Models\Job::$experience,
                        function ($carry, $item) {
                            $carry[ucfirst($item)] = $item;
                            return $carry;
                        },
                        [],
                    )" :value="old('experience')" />
                </div>

                <div>
                    <x-label for="experience" :required="true">Category</x-label>
                    <x-radio-group name="category" :allOption="false" :value="old('category')" :options="App\Models\Job::$category" />
                </div>

                <x-button class="w-full col-span-2">Post Job</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
