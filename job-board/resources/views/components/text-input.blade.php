<div class="relative group">
    @if ($formRef)
        <button type="button" @click="$refs['input-{{$name}}'].value='';$refs['{{$formRef}}'].submit();"
            class="hidden absolute top-0 right-0 bold group-hover:flex h-full items-center px-2 hover:bg-slate-100 rounded-r-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4 text-slate-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    @endif
    <input x-ref="input-{{ $name }}" type="{{$type}}" placeholder="{{ $placeholder }}" name="{{ $name }}"
        value="{{ $value }}" id="{{ $name }}"
        class="w-full rounded-md border-0 py-1.5 px-2.5 pr-8 text-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:ring-2">
</div>
