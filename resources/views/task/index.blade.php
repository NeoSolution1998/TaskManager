@extends('layouts.app')

@section('content')
    <main class='container py-4'>
        @include('flash::message')

        @auth
            <div class="d-flex mb-3">
                <div class="ms-auto">
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary ml-auto">
                        Создать задачу </a>
                </div>
            </div>
        @endauth

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
                @foreach ($tasks->all() as $task)
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
                                    data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('удалить')</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
