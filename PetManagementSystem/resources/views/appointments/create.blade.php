@extends('layouts.main')

@section('title', 'Agendar Consulta')

@section('content')

<div class="col-md-8 offset-md-2">
    <!-- Botão Voltar -->
    <a href="{{ url()->previous() }}" class="btn btn-primary border mb-4">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>

    <div class="bg-light p-4 p-md-5 rounded-3">
        <div class="text-center mb-4">
            <h1 class="h2">Agende uma consulta</h1>
            <p class="text-muted">Preencha os dados abaixo para marcar o horário do seu pet.</p>
        </div>

        <form action="/appointment" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="vets_name" class="form-label">Nome do Veterinário(a):</label>
                    <input type="text" class="form-control" id="vets_name" name="vets_name" placeholder="Ex: Dr. João" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pet_id" class="form-label">Para qual Pet?</label>
                    <select name="pet_id" id="pet_id" class="form-select" required>
                        <option value="" disabled selected>Selecione um pet...</option>
                        @foreach($pets as $pet)
                            {{-- O 'value' deve ser apenas o ID --}}
                            <option value="{{ $pet->id }}">{{ $pet->name }} ({{ $pet->species }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Data e Hora da Consulta:</label>
                <input type="datetime-local" class="form-control" id="date" name="date" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Breve descrição (motivo da consulta):</label>
                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Ex: Vacina anual, check-up, não está comendo bem..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">
                <i class="fas fa-calendar-check me-2"></i> Agendar Consulta
            </button>
        </form>
    </div>
</div>

@endsection