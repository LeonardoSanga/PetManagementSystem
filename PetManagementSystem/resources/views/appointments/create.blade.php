@extends('layouts.main')

@section('title', 'Agendar consulta')

@section('content')

<div id="pet-create-container" class="col-md-6 offset-md-3">
    <h1>Agende sua consulta</h1>
    <form action="/appointment" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="vets_name">Nome do Veterinário:</label>
            <input type="text" class="form-control" id="vets_name" name="vets_name" placeholder="Nome do veterinário">
        </div>

        <div class="form-group">
            <label for="pet_id">Qual o Pet?</label>
            <select name="pet_id" id="pet_id"  class="form-control">
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }} ">{{ $pet->name }} | {{ $pet->species }} | {{ $pet->breed }} |  {{ date('d/m/Y', strtotime($pet->birth_date)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Data da consulta:</label>
            <input type="datetime-local" class="form-control" id="date" name="date">
        </div>

         <div class="form-group">
            <label for="description">Breve descrição do problema:</label>
            <textarea name="description" id="description" class="form-control" placeholder="O que há com seu Pet?"></textarea>
        </div>


        <input type="submit" class="btn btn-primary" value="Cadastrar pet">
    </form>
</div>

@endsection