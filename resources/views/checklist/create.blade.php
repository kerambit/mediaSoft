@extends('layouts.app')
@section('title', 'Создать новый список')

@section('content')
    @include('includes.errors')

    <h2>Создание нового списка</h2>

    <form action="{{ route('checklist.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <div class="form-group">
                <label for="inputListName">Название списка</label>
                <input type="text" class="form-control" name="title" id="inputListName" placeholder="Введите название списка">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Создать список</button>
    </form>
@endsection
