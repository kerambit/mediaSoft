@extends('layouts.app')
@section('title')
    Список {{ $checklist->title }}
@endsection

@section('content')
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
                <button class="btn btn-danger" type="submit">Удалить</button>
            </form>
        </div>
    </div>
@endsection
