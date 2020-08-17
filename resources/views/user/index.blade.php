@extends('layouts.app')
@section('title', 'Список пользователей')

@section('content')
    @include('includes.status')
    @foreach($users as $user)
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">Имя {{ $user->name}}</h5>
                <p class="card-text">Эл.почта {{ $user->email }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Лимит составляет: {{ $user->checklist_limit }}</li>
                <li class="list-group-item">Активных чеклистов: {{ count($user->checklists) }}</li>
                <li class="list-group-item">Группа пользователей: {{ $user->roles->first()->name }}</li>
                @if ($user->banned == true)
                    <li class="list-group-item" style="text-decoration: underline; text-decoration-color: red">Пользователь заблокирован</li>
                @else
                    <li class="list-group-item">Пользователь не заблокирован</li>
                @endif
            </ul>
            <div class="card-body">
                <a href="{{ route('user.edit', $user->id) }}" class="card-link">Редактировать пользователя</a>
                @can('destroy', $user)
                    @if ($user->banned == false)
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Забанить пользователя</button>
                        </form>
                    @else
                        <form action="{{ route('user.restore', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success" type="submit">Разблокировать пользователя</button>
                        </form>
                    @endif
                @endcan
            </div>
        </div>
    @endforeach
@endsection
