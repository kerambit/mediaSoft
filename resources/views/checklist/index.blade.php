@extends('layouts.app')
@section('title', 'Список листов')

@section('content')
    @include('includes.status')
    @if ($checklist->isEmpty())
        <div class="row">
            <div class="col-sm-10"><h1>Список пуст. Хотите создать новый список?</h1></div>
        </div>
        <a href="{{ route('checklist.create') }}" class="btn btn-primary">Создать</a>
    @else
        <ul class="list-group">
            @foreach ($checklist as $list)
                <li class="list-group-item"><a href="{{ route('checklist.show', $list->id) }}">{{ $list->title }}</a></li>
            @endforeach
        </ul>
    @endif
@endsection
