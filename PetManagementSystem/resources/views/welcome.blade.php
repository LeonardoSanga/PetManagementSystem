@extends('layouts.main')

@section('title', 'San7 Gestão de Pets')

@section('content')
        
<h1>Olá mundo</h1>

@foreach($pets as $pet)
<p>{{ $pet->name }} {{ $pet->species }} {{ $pet->breed }} {{ $pet->birth_date }}</p>
<img src="/img/pets/{{ $pet->image }}" alt="">
@endforeach
@endsection