<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use \App\Models\Task;

Route::get('/', function () {
    return redirect()->route('task.index');
});


Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(5)
    ]);
})->name('task.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('task.edit');

Route::get('/tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
})->name('task.show');

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('task.show', ['task' => $task->id])
        ->with('success', 'Task saved!');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    // $data = ;

    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];

    // $task->save();

    $task->update($request->validated());

    return redirect()->route('task.show', ['task' => $task->id])
        ->with('success', 'Task updated!');
})->name('tasks.update');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();

    return redirect()->route('task.index')
        ->with('success', 'Task deleted');
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success', "Task completed!");
})->name('task.toggle-complete');

Route::fallback(function () {
    return 'Fallback Route';
});
