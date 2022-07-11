<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Task;
use App\Models\Label;
use App\Models\LabelTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Requests\StoreTaskRequest;


class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();
        $authors = User::all();
        $statuses = TaskStatus::all();

        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->paginate();
        return view('task.index', compact('tasks', 'authors', 'statuses'));
    }

    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('task.show', compact('task'));
    }
    public function create()
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.create', compact('users', 'statuses', 'labels'));
    }

    public function store(StoreTaskRequest $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status_id' => 'required'
        ]);

        $task = new Task();
        $task->fill($request->all());
        $task->created_by_id = Auth::user()->id;
        $task->save();

        if ($request->input('labels')) {
            $task->labels()->sync($request->input('labels'));
        }

        flash('Задача успешно создана');
        return redirect()->route('tasks.index');
    }
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $task->assigned_to_id ? $user = User::findOrFail($task->assigned_to_id) : $user = 'не указан';

        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('task.edit', compact('task', 'user', 'statuses', 'users', 'labels'));
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'status_id' => 'required'
        ]);

        $task->fill($request->all());
        $task->save();

        if ($request->input('labels')) {
            $task->labels()->sync($request->input('labels'));
        }

        flash('Задача успешно изменена');
        return redirect()->route('tasks.index');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        flash('Задача успешно удалена')->success();
        return redirect()
            ->route('tasks.index');
    }
}
