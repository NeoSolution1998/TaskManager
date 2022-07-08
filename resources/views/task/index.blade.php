@extends('layouts.app')

@section('content')
    <main class='container py-4'>
        @include('flash::message')

        <div class="d-flex mb-3">
            <div>
                <form method="GET" action="{{ route('tasks.index') }}" accept-charset="UTF-8">
                    <div class="row g-1">
                        <div class="col">
                            <select class="form-select me-2" name="filter[status_id]">
                                <option value="">Статус</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select me-2" name="filter[created_by_id]">
                                <option selected="selected" value="">Автор</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select me-2" name="filter[assigned_to_id]">
                                <option selected="selected" value="">Исполнитель</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input class="btn btn-outline-primary me-2" type="submit" value="Применить">
                        </div>

                    </div>
                </form>
            </div>
            @auth
                <div class="ms-auto">
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">
                        Создать задачу </a>
                </div>
            @endauth
        </div>
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>@lang('id')</th>
                    <th>@lang('Статус')</th>
                    <th>@lang('Имя')</th>
                    <th>@lang('Автор')</th>
                    <th>@lang('Исполнитель')</th>
                    <th>@lang('Дата создания')</th>
                    @auth
                        <th>@lang('действия')</th>
                    @endauth
                </tr>
            </thead>

            <tbody>

                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->status->name }}</td>
                        <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                        <td>{{ $task->author->name }}</td>
                        <td>{{ $task->assigned_to_id ? $authors->find($task->assigned_to_id)->name : 'Исполнитель не определен' }}
                        </td>
                        <td>{{ $task->created_at->format('d.m.Y') }}</td>
                        @auth
                            <td>
                                <a class="text-decoration-none" href="{{ route('tasks.edit', $task->id) }}">
                                    Изменить </a>

                                <a class="text-danger" href="{{ route('tasks.destroy', $task->id) }}"
                                    data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('Удалить')</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $tasks->links() }}
    </main>
@endsection
