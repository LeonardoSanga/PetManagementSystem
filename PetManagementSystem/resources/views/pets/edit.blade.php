@extends('layouts.main')

@section('title', 'Editando ' . $pet->name)

@section('content')
<div class="col-md-8 offset-md-2">
    <a href="{{ url()->previous() }}" class="btn btn-primary border mb-4">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>

    <div class="bg-light p-4 p-md-5 rounded-3">
        <div class="text-center mb-5">
            <h1 class="h2">Editando Pet</h1>
            <p class="text-muted">Ajuste os dados do(a) <strong>{{ $pet->name }}</strong>.</p>
        </div>

        <form method="POST" action="/pets/update/{{ $pet->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row align-items-center">
                {{-- Coluna da Imagem --}}
                <div class="col-md-4 text-center">
                    <label for="image" class="form-label fw-bold">Imagem do Pet</label>
                    <img src="/img/pets/{{ $pet->image }}" alt="{{ $pet->name }}" class="img-preview mb-3">
                    <input type="file" class="form-control" id="image" name="image">
                    <small class="form-text text-muted mt-2 d-block">Envie uma nova imagem para alterar a atual.</small>
                </div>

                {{-- Coluna dos Dados --}}
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $pet->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="species" class="form-label">Espécie:</label>
                        <input type="text" class="form-control" id="species" name="species" value="{{ $pet->species }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="breed" class="form-label">Raça:</label>
                        <input type="text" class="form-control" id="breed" name="breed" value="{{ $pet->breed }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="birth_date" class="form-label">Data de nascimento:</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ \Carbon\Carbon::parse($pet->birth_date)->format('Y-m-d') }}" required>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="fas fa-save me-2"></i> Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>



@endsection