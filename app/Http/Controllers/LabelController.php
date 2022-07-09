<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Task;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\StoreLabelRequest;

class LabelController extends Controller
{
    public function index()
    {
        $labels = new Label();
        return view('label.index', compact('labels'));
    }

    public function show(string $id)
    {
        $label = Label::findOrFail($id);
        return view('label.show', compact('label'));
    }

    public function create()
    {
        return view('label.create');
    }

    public function store(StoreLabelRequest $request)
    {
        $data = $request->validated();

        $label = new Label();
        $label->fill($request->all());
        $label->save();
        flash('Метка успешно создана');
        return redirect()->route('labels.index');
    }

    public function edit(string $id)
    {
        $label = Label::findOrFail($id);
        return view('label.edit', compact('label'));
    }

    public function update(Request $request, string $id)
    {
        $label = Label::findOrFail($id);

        $this->validate($request, [
            'name' => 'required'
        ]);

        $label->fill($request->all());
        $label->save();
        flash('Метка успешно изменена');
        return redirect()->route('labels.index');
    }
    public function destroy(string $id)
    {
        $label = Label::findOrFail($id);

        if ($label->tasks->isNotEmpty()) {
            flash(__('Не удалось удалить метку'))->error();
        } else {
            $label->delete();
            flash(__('Метка успешно удалена'))->success();
        }

        return redirect()->route('labels.index');
    }
}
