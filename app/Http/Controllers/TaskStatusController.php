<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Http\Requests\StoreTaskStatusRequest;

class TaskStatusController extends Controller
{
    public function index()
    {
        $task_statuses = TaskStatus::paginate()->all();
        return view('task_status.index', compact('task_statuses'));
    }

    public function create()
    {
        $task_statuses = TaskStatus::paginate()->all();
        return view('task_status.create', compact('task_statuses'));
    }

    public function store(StoreTaskStatusRequest $request)
    {
        $data = $request->validated();

        $task_status = new TaskStatus();
        $task_status->fill($request->all());
        $task_status->save();

        flash('Статус успешно создан');

        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(string $id)
    {
        $status_id = TaskStatus::findOrFail($id);
        return view('task_status.edit', compact('status_id'));
    }

    public function update(Request $request, string $id)
    {
        $status = TaskStatus::findOrFail($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $status->fill($request->all());
        $status->save();

        flash('Статус успешно изменён');
        return redirect()->route('task_statuses.index');
    }

    public function destroy(string $id)
    {
        $status = TaskStatus::findOrFail($id);

        if ($status->tasks->isNotEmpty()) {
            flash('Не удалось удалить статус')->error();
            return redirect()->route('task_statuses.index');
        } else {
            flash('Статус успешно удалён');
            $status->delete();
        }
        return redirect()->route('task_statuses.index');
    }
}
