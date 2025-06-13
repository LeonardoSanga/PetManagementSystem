@extends('layouts.main')

@section('title', 'Cadastro do PET')

@section('content')

<div class="col-md-8 offset-md-2">
    <a href="{{ url()->previous() }}" class="btn btn-primary border mb-4">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>

    <div class="bg-light p-4 p-md-5 rounded-3">
        <div class="text-center mb-4">
            <h1 class="h2">Cadastre o seu pet</h1>
            <p class="text-muted">Preencha os dados abaixo para adicionar um novo membro à família.</p>
        </div>

        <form action="/pets" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ex: Thor" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="species" class="form-label">Espécie:</label>
                    <input type="text" class="form-control" id="species" name="species" placeholder="Ex: Cachorro" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="breed" class="form-label">Raça:</label>
                    <input type="text" class="form-control" id="breed" name="breed" placeholder="Ex: Golden Retriever" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="birth_date" class="form-label">Data de nascimento:</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date">
            </div>

            <div class="mb-4">
                <label for="image" class="form-label">Foto do Pet:</label>
                <div class="file-upload-wrapper text-center">
                    <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                    <p class="mt-2">Clique aqui para selecionar uma imagem</p>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">
                <i class="fas fa-paw me-2"></i> Cadastrar Pet
            </button>
        </form>
    </div>
</div>

<style>

</style>

@endsection