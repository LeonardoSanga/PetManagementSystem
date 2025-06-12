@extends('layouts.main')

@section('title', 'Editando ' . $user->name)

@section('content')
<div class="col-md-8 offset-md-2">
    <a href="{{ url()->previous() }}" class="btn btn-light border mb-4">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>

    <div class="bg-light p-4 p-md-5 rounded-3">
        <div class="text-center mb-5">
            <h1 class="h2">Editando Usuário</h1>
            <p class="text-muted">Ajuste os dados e permissões de <strong>{{ $user->name }}</strong>.</p>
        </div>

        <form method="POST" action="/users/update/{{ $user->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">Tipo de usuário:</label>
                <select name="user_type" id="user_type" class="form-select" required>
                    {{-- Lógica para manter a opção correta selecionada --}}
                    <option value="0" @if($user->user_type == 0) selected @endif>Usuário comum</option>
                    <option value="1" @if($user->user_type == 1) selected @endif>Usuário Administrador</option>
                </select>
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