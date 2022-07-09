@extends('layouts.app')

@section('content')
    <main class="container py-4">
        <h1 class="mb-5">@lang('Создать статус')</h1>
        <form method="POST" action={{ route('task_statuses.store') }} accept-charset="UTF-8" class="w-50">
            @csrf
            <div class="form-group mb-3">
                <label for="name">@lang('Имя')</label>
                <input class="form-control" name="name" type="text" id="name">
            </div>
        
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input class="btn btn-primary mt-3" type="submit" value="Создать">
        </form>
    </main>
@endsection
