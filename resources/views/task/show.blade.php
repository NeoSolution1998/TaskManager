@extends('layouts.app')

@section('content')
    <main class='container py-4'>
        <table class="table caption-top">
            <caption>Просмотр задачи</caption>
            <thead>
                <tr>
                    <th scope="col">Имя задачи</th>
                    <th scope="col">{{ $task->name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Статус</th>
                    <td>{{ $task->status->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Описание</th>
                    <td>{{ $task->description }}</td>
                </tr>
                <tr>
                    <th scope="row">Метки</th>
                    <td>
                        <ul>
                            @foreach ($task->labels as $label)
                                <li>{{ $label->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
@endsection
