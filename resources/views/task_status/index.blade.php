@extends('layouts.app')

@section('content')
    <main class="container py-4">

        @include('flash::message')

        <h1 class="mb-5">Статусы</h1>
        @auth
            <a href="{{ route('task_statuses.create') }}" class="btn btn-primary">@lang('Создать статус')</a>
        @endauth

        <table class="table mt-2">
            <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Имя')</th>
                    <th>@lang('Дата создания')</th>
                    @auth
                        <th>@lang('действия')</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($task_statuses as $status)
                    <tr>
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>{{ $status->created_at->format('d.m.Y') }}</td>
                        @auth
                            <td>
                                <a class="text-danger" href="{{ route('task_statuses.destroy', $status->id) }}"
                                    data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('Удалить')</a>
                                <a href="{{ route('task_statuses.edit', $status->id) }}">@lang('Изменить')</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>

    </main>
@endsection
