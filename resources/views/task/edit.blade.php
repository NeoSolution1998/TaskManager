@extends('layouts.app')

@section('content')
    <main class="container by-4">
        <h1 class="mb-5">ИЗМЕНЕНИЕ ЗАДАЧИ</h1>
        <form method="POST" action="{{ route('tasks.update', $task->id) }}" accept-charset="UTF-8" class="w-50">
            @csrf
            @method('PATCH')
            <div class="form-group mb-3">
                <label for="name">Имя</label>
                <input class="form-control" name="name" type="text" id="name" value="{{$task->name}}">
            </div>

            <div class="form-group mb-3">
                <label for="description">Описание</label>
                <textarea class="form-control" name="description" cols="50" rows="10" id="description" value="">{{$task->description}}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="status_id">Статус</label>
                <select class="form-control" id="status_id" name="status_id">
                    <option selected="selected" value="{{$task->status->id}}">{{$task->status->name ?? '----------'}} </option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                    <option value="">----------</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="assigned_to_id">Исполнитель</label>
                <select class="form-control" id="assigned_to_id" name="assigned_to_id">
                    <option selected="selected" value="">{{$user->name ?? $user}} </option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                    <option value="">----------</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="labels">Метки</label>
                <select class="form-control" multiple="" name="labels[]">
                    <option value="">----------</option>
                    @foreach ($labels as $label)
                        <option value="{{ $label->id }}">{{ $label->name }}</option>
                    @endforeach
            </div>

            <input class="btn btn-primary mt-3" type="submit" value="Обновить">
        </form>
    </main>
@endsection
