<div>
    @if ($allOption)
        <label class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" value="" @checked(!request($name))>
            <span class="ml-2">All</span>
        </label>
    @endif
    {{--
    optionsWithLabels ist eine Funktion, die im Model erstellt wurde um dafür zu sorgen, dass wir
    IMMER ein Assoc haben.
    Um, je nach Bedarf für jede Option es anderes Label zu haben.
    --}}
    @foreach ($optionsWithLabels as $label => $option)
        <label class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" value="{{ $option }}" @checked($option === ($value ?? request($name)))>
            <span class="ml-2">{{ $label }}</span>
        </label>
    @endforeach

    @error($name)
        <div class="mt-1 text-xs text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>
