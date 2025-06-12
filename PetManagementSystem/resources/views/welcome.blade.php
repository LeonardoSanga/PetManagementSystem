@extends('layouts.main')

@section('title', 'San7 Gestão de Pets - Painel Principal')

@section('content')

<div class="container mt-4">
    {{-- SEÇÃO DE BOAS-VINDAS E AÇÕES RÁPIDAS --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2">Olá, {{ auth()->user()->name }}!</h1>
            <p class="text-muted">Bem-vindo(a) ao seu painel de gestão.</p>
        </div>

    </div>

    <hr>

    {{-- SEÇÃO 1: MEUS PETS --}}
    <h2 class="h4 mb-4">Meus Pets</h2>

    <div class="row">
        @forelse ($pets as $pet)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="/img/pets/{{ $pet->image }}" class="card-img-top" alt="Foto de {{ $pet->name }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $pet->name }}</h5>
                    <p class="card-text text-muted">{{ $pet->species }} - {{ $pet->breed }}</p>
                    <p class="card-text">
                        <strong>Idade:</strong> {{ \Carbon\Carbon::parse($pet->birth_date)->age }} anos
                    </p>
                    <div class="mt-auto">
                        <a href="/pets/edit/{{ $pet->id }}" class="btn btn-outline-primary w-100">
                            Gerenciar Pet
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        {{-- MENSAGEM PARA QUANDO NÃO HÁ PETS CADASTRADOS --}}
        <div class="col-12">
            <div class="text-center p-5 bg-light rounded">
                <i class="fas fa-paw fa-3x text-muted mb-3"></i>
                <h3 class="h4">Você ainda não tem nenhum pet cadastrado.</h3>
                <p>Clique em "Cadastrar Pet" para começar.</p>
            </div>
        </div>
        @endforelse
    </div>

    <hr class="my-5">

    {{-- SEÇÃO 2: PRÓXIMAS CONSULTAS --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Próximas Consultas</h2>
        <a href="/appointment/dashboard" class="btn btn-outline-secondary btn-sm">Ver todas</a>
    </div>

    <div class="list-group">
        @forelse ($appointments as $appointment)

        {{-- INÍCIO DA LÓGICA DE PERMISSÃO --}}
        @if(auth()->user()->user_type == 1)
        {{-- CASO 1: O usuário é um Administrador (mostra o link clicável) --}}
        <a href="/appointment/edit/{{ $appointment->id }}" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Consulta para: {{ $appointment->pet->name }}</h5>
                <small class="text-success fw-bold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y \à\s H:i') }}</small>
            </div>
            <p class="mb-1">Veterinário(a): {{ $appointment->vets_name }}</p>
            <small class="text-muted">Descrição: {{ Str::limit($appointment->description, 100) }}</small>
        </a>
        @else
        {{-- CASO 2: O usuário é Comum (mostra as informações, mas não é clicável) --}}
        <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Consulta para: {{ $appointment->pet->name }}</h5>
                <small class="text-success fw-bold">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y \à\s H:i') }}</small>
            </div>
            <p class="mb-1">Veterinário(a): {{ $appointment->vets_name }}</p>
            <small class="text-muted">Descrição: {{ Str::limit($appointment->description, 100) }}</small>
        </div>
        @endif
        {{-- FIM DA LÓGICA DE PERMISSÃO --}}

        @empty
        {{-- MENSAGEM PARA QUANDO NÃO HÁ CONSULTAS --}}
        <div class="list-group-item text-center text-muted p-4">
            <p class="mb-1"><i class="far fa-calendar-check me-2"></i>Nenhuma consulta agendada no momento.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Estilo para as imagens dos pets nos cards --}}
<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

@endsection