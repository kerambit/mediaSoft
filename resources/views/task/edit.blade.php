@extends('layouts.app')
@section('title')
    Редактирование {{ $task->text }}
@endsection

@section('content')
    @include('includes.errors')
    <form action="{{ route('task.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputTaskName">Название пункта</label>
            <input type="text" class="form-control" name="text" id="inputTaskName" value="{{ $task->text }}" placeholder="Введите название пункта списка">
            <input type="hidden" name="checklist_id" value="{{ $task->checklist_id }}">
            <input type="hidden" name="user_id" value="{{ $task->user_id }}">
            <input type="hidden" name="checked" value="{{ $task->checked }}">
        </div>
        <button type="submit" class="btn btn-primary">Отредактировать список</button>
    </form>
    <form action="{{ route('task.destroy', $task->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Удалить пункт</button>
    </form>
@endsection
