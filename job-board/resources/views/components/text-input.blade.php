<div class="relative group">
    {{-- Nicht wie im Kurs:
        Ohne Sep. Form Id, es wird direkt das Parent Form submitted
            => Weniger nonsens Attribute.
        Leeren-buttons nur bei Hover über dem Parent anzeigen:
            => Weniger Buttons aufeinmal zu sehen = Cleaner.
        Hovereffeckt für Button
            => weil ich's kann :-P
    --}}
    <button type="button" onclick="document.getElementById('{{$name}}').value='';this.closest('form').submit();"
        class="hidden absolute top-0 right-0 bold group-hover:flex h-full items-center px-2 hover:bg-slate-100 rounded-r-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-4 text-slate-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    <input type="text" placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value }}"
        id="{{ $name }}"
        class="w-full rounded-md border-0 py-1.5 px-2.5 pr-8 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2">
</div>
