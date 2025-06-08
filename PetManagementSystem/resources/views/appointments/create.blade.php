@extends('layouts.main')

@section('title', 'Agendar consulta')

@section('content')

<div id="pet-create-container" class="col-md-6 offset-md-3">
    <h1>Agende sua consulta</h1>
    <form action="/pets" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="pets_name">Nome do Pet:</label>
            <input type="text" class="form-control" id="pets_name" name="pets_name" placeholder="Nome do pet">
        </div>

        <div class="form-group">
            <label for="species">Espécie:</label>
            <input type="text" class="form-control" id="species" name="species" placeholder="Espécie do pet">
        </div>

        <div class="form-group">
            <label for="breed">Raça:</label>
            <input type="text" class="form-control" id="breed" name="breed" placeholder="Raça do pet">
        </div>

        <div class="form-group">
            <label for="birth_date">Data da consulta:</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date">
        </div>

        <div class="form-group">
            <label for="image">Imagem do Pet:</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <input type="submit" class="btn btn-primary" value="Cadastrar pet">
    </form>
</div>

@endsection