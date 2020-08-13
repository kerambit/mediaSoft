@extends('layouts.app')
@section('title')
    Список {{ $checklist->title }}
@endsection

@section('content')
    @include('includes.status')
    @include('includes.errors')

    <div class="card">
        <div class="card-header">
            {{ $checklist->title }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Содержит чек листов: {{ count($checklist->tasks) }}</h5>
            <a href="{{ route('checklist.edit', $checklist->id) }}" class="btn btn-primary">Редактировать</a>
            <form action="{{ route('checklist.destroy', $checklist->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Удалить список</button>
            </form>
            <form action="{{ route('tasks.update', $checklist->id) }}" method="POST">
                <ul class="list-group list-group-flush">
                    @foreach ($checklist->tasks as $task)
                        <li class="list-group-item">
                            <div class="custom-control custom-checkbox">
                                @if ($task->checked == true)
                                    <input type="checkbox" class="custom-control-input" id="check{{ $task->id }}" checked name="checked[{{ $task->id }}]">
                                @else
                                    <input type="checkbox" class="custom-control-input" id="check{{ $task->id }}" name="checked[{{ $task->id }}]">
                                @endif
                                <input type="hidden" name="checklist_id" value="{{ $checklist->id }}">
                                <input type="hidden" name="id[{{ $task->id }}]" value="{{ $task->id }}">
                                    <label class="custom-control-label" for="check{{ $task->id }}"><a href="{{ route('task.edit', $task->id) }}">{{ $task->text }}</a></label>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">Отредактировать чек лист</button>
            </form>

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="form-group">
                        <label for="inputTaskName">Добавить пункт в список</label>
                        <input type="text" class="form-control" name="text" id="inputTaskName" placeholder="Введите название пункта">
                        <input type="hidden" name="checklist_id" value="{{ $checklist->id }}">
                        <input type="hidden" name="user_id" value="{{ $checklist->user_id }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Внести в список</button>
            </form>
        </div>
    </div>
@endsection
