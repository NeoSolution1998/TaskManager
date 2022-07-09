@extends('layouts.app')

@section('content')
    <main class="container py-4">

        @include('flash::message')

        <h1 class="mb-5">Метки</h1>
        @auth
            <a href="{{ route('labels.create') }}" class="btn btn-primary">@lang('Создать метку')</a>
        @endauth

        <table class="table mt-2">
            <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Имя')</th>
                    <th>@lang('Описание')</th>
                    <th>@lang('Дата создания')</th>
                    @auth
                        <th>@lang('действия')</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($labels->all() as $label)
                    <tr>
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->created_at->format('d.m.Y') }}</td>
                        @auth
                            <td>
                                <a class="text-danger" href="{{ route('labels.destroy', $label->id) }}"
                                    data-confirm="Вы уверены?" data-method="delete" rel="nofollow">@lang('Удалить')</a>
                                <a href="{{ route('labels.edit', $label->id) }}">@lang('Изменить')</a>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>

    </main>
@endsection
