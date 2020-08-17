@extends('layouts.app')
@section('title', 'Редактирование пользователя')

@section('content')
    @include('includes.status')
    @include('includes.errors')
    <h2>Пользователь {{ $user->name }}</h2>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputUserName">Имя пользователя</label>
            <input type="text" class="form-control" name="name" id="inputUserName" value="{{ $user->name }}" placeholder="Введите имя пользователя">

            <label for="inputLimit">Введите лимит на чеклисты</label>
            <input type="number" class="form-control" name="checklist_limit" id="inputLimit" value="{{ $user->checklist_limit }}" placeholder="Введите лимит">
        </div>
        <button type="submit" class="btn btn-primary">Отредактировать пользователя</button>
    </form>
    <h2>Список чек листов пользователя</h2>
    <div class="container">
        <ul class="list-group list-group-flush">
            @foreach ($user->checklists as $checklist)
                <li class="list-group-item">
                    <a href="{{ route('user.checklist.show', [$user->id, $checklist->id]) }}">{{ $checklist->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
