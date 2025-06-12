@extends('layouts.main')

@section('title', 'Minhas Consultas')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Minhas Consultas</h1>
        @if(auth()->user()->user_type == 1)
        <a href="/appointment/create" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Cadastrar Nova Consulta
        </a>
        @endif
    </div>

    <div class="my-4">
        <h4>Buscar por Data</h4>
        <form action="/appointment/dashboard" method="GET">
            <div class="input-group">
                <input type="date" id="search" name="search" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if(count($appointments) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Veterinário(a)</th>
                        <th scope="col" class="text-center">Data e Hora</th>
                        {{-- INÍCIO DA MUDANÇA 1: MOSTRA O CABEÇALHO APENAS PARA ADMINS --}}
                        @if(auth()->user()->user_type == 1)
                            <th scope="col" class="text-center">Ações</th>
                        @endif
                        {{-- FIM DA MUDANÇA 1 --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td class="text-center">{{ $appointment->vets_name }}</td>
                            <td class="text-center">{{ date('d/m/Y H:i', strtotime($appointment->appointment_date)) }}</td>
                            {{-- INÍCIO DA MUDANÇA 2: MOSTRA OS BOTÕES APENAS PARA ADMINS --}}
                            @if(auth()->user()->user_type == 1)
                            <td class="text-center">
                                <a href="/appointment/edit/{{ $appointment->id }}" class="btn btn-info btn-sm edit-btn" title="Re-agendar">
                                    <i class="fas fa-pencil-alt"></i> Re-agendar
                                </a>
                                <form action="/appointment/{{ $appointment->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    {{-- Nota: A confirmação via onclick é funcional, mas para uma UX mais moderna, considere usar uma janela modal (modal) no futuro. --}}
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn" title="Cancelar Consulta" onclick="return confirm('Tem certeza que deseja cancelar esta consulta?')">
                                        <i class="fas fa-trash-alt"></i> Cancelar
                                    </button>
                                </form>
                            </td>
                            @endif
                            {{-- FIM DA MUDANÇA 2 --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        @if($search ?? false)
            <p>Nenhuma consulta encontrada para a data informada. <a href="/appointment/dashboard">Ver todas.</a></p>
        @else
            <p>Você ainda não possui consultas agendadas.</p>
        @endif
    @endif
</div>

@endsection