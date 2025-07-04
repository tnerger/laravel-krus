<div>
    <label class="mb-1 flex items-center">
        <input type="radio" name="{{ $name }}" value="" @checked(!request($name))>
        <span class="ml-2">All</span>
    </label>
    {{--
    optionsWithLabels ist eine Funktion, die im Model erstellt wurde um dafür zu sorgen, dass wir
    IMMER ein Assoc haben.
    Um, je nach Bedarf für jede Option es anderes Label zu haben.
    --}}
    @foreach ($optionsWithLabels as $label => $option)
        <label class="mb-1 flex items-center">
            <input type="radio" name="{{ $name }}" value="{{ $option }}" @checked($option === request($name))>
            <span class="ml-2">{{ $label }}</span>
        </label>
    @endforeach
</div>
