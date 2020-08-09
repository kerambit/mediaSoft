@extends('layouts.app')
@section('title', 'Добро пожаловать')

@section('content')
<h2>Добро пожаловать {{ $user->name }}</h2>
<h2>Ваш лимит составляет {{ $user->checklist_limit }}</h2>

@endsection
