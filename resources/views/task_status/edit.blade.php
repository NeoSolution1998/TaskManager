@extends('layouts.app')

@include('flash::message')

@section('content')

    <main class="container py-4">
        <h1 class="mb-5">@lang('Изменение статуса')</h1>
        <form method="POST" action={{ route('task_statuses.update', $status_id) }} accept-charset="UTF-8" class="w-50">
            @csrf
            @method('PATCH')
            <div class="form-group mb-3">
                <label for="name">@lang('Имя')</label>
                <input class="form-control" name="name" type="text" id="name">
            </div>

            <input class="btn btn-primary mt-3" type="submit" value="Обновить">
        </form>
    </main>
@endsection
