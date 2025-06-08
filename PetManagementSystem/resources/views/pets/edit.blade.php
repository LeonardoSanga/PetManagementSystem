@extends('layouts.main')

@section('title', 'Editando usuário')

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3" >
        <h1>Editando: {{ $pet->name }}</h1>
        <form method="POST" action="/pets/update/{{ $pet->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="image">Imagem do Pet:</label>
                <input type="file" class="form-control-file" id="image" name="image" >
                <img src="/img/pets/{{ $pet->image }}" alt="{{ $pet->name }}" class="img-preview">
            </div>

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $pet->name }}">
            </div>

            <div class="form-group">
                <label for="species">Espécie:</label>
                <input type="text" class="form-control" id="species" name="species" value="{{ $pet->species }}">
            </div>

            <div class="form-group">
                <label for="breed">Raça:</label>
                <input type="text" class="form-control" id="breed" name="breed" value="{{ $pet->breed }}">
            </div>

            <div class="form-group">
                <label for="birth_date">Data de nascimento:</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ \Carbon\Carbon::parse($pet->birth_date)->format('Y-m-d') }}">
            </div>

            <input type="submit" class="btn btn-primary" value="Editar pet">
        </form>
    </div>


@endsection