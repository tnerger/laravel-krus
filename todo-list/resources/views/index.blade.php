
@extends('layouts.app')

@section('title', 'The List of tasks')


@section('content')

    <nav class="mb-4">
        <a class="link" href="{{route('tasks.create')}}">NEW!</a>
    </nav>

    @forelse ($tasks as $task)
        <div>
            <a
            href="{{ route('task.show', ['task' => $task->id]) }}"
            @class(['line-through' => $task->completed])
            >{{ $task->title }}</a>
        </div>
    @empty
        <div>NO TASKS!</div>
    @endforelse

    @if ($tasks->count())
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @endif

@endsection
