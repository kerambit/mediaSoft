@extends('layouts.app')
@section('title', 'Добро пожаловать')

@section('content')
@include('includes.status')
<h2>Добро пожаловать {{ $user->name }}</h2>
<h2>Ваш лимит составляет {{ $user->checklist_limit }}</h2>

@endsection
