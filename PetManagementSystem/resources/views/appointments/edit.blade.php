@extends('layouts.main')

@section('title', 'Editando Consulta')

@section('content')
<div class="col-md-8 offset-md-2">
    <a href="{{ url()->previous() }}" class="btn btn-primary border mb-4">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>

    <div class="bg-light p-4 p-md-5 rounded-3">
        <div class="text-center mb-4">
            <h1 class="h2">Editando a Consulta</h1>
            {{-- Para a linha abaixo funcionar, garanta que a relação 'pet' está sendo carregada com a consulta --}}
            <p class="text-muted">Ajuste os detalhes da consulta para <strong>{{ $appointment->pet->name ?? 'Pet não encontrado' }}</strong></p>
        </div>

        <form method="POST" action="/appointment/update/{{ $appointment->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="vets_name" class="form-label">Nome do Veterinário(a):</label>
                    <input type="text" class="form-control" id="vets_name" name="vets_name" value="{{ $appointment->vets_name }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pet_id" class="form-label">Para qual Pet?</label>
                    <select name="pet_id" id="pet_id" class="form-select" required>
                        {{-- Lógica para manter o pet correto selecionado --}}
                        @foreach($pets as $pet)
                            <option value="{{ $pet->id }}" @if($appointment->pet_id == $pet->id) selected @endif>
                                {{ $pet->name }} ({{ $pet->species }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="appointment_date" class="form-label">Data e Hora da Consulta:</label>
                {{-- Formata a data para o padrão do input datetime-local --}}
                <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" value="{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Breve descrição (motivo da consulta):</label>
                {{-- O conteúdo do textarea vai entre as tags --}}
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $appointment->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">
                <i class="fas fa-save me-2"></i> Salvar Alterações
            </button>
        </form>
    </div>
</div>
@endsection