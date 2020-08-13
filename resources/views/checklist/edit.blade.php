@extends('layouts.app')
@section('title')
    Редактировать список {{ $checklist->title }}
@endsection

@section('content')
    @include('includes.errors')
    <form action="{{ route('checklist.update', $checklist->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="inputChecklistName">Название списка</label>
            <input type="text" class="form-control" name="title" id="inputChecklistName" value="{{ $checklist->title }}" placeholder="Введите название списка">
        </div>
        <button type="submit" class="btn btn-primary">Отредактировать список</button>
    </form>
@endsection

