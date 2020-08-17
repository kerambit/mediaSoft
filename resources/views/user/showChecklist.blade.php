@extends('layouts.app')
@section('title')
    Список {{ $checklist->title }}
@endsection

@section('content')

    <h2>Список чек листов {{ $user->name }}</h2>
    <h2>Еще может создать списков {{ $user->checklist_limit - count($user->checklists) }}</h2>

    <div class="card">
        <div class="card-header">
            {{ $checklist->title }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Содержит чек листов: {{ count($checklist->tasks) }}</h5>

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
                            <label class="custom-control-label" for="check{{ $task->id }}">{{ $task->text }}</label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

