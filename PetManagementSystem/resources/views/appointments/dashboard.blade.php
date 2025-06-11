@extends('layouts.main')

@section('title', 'Minhas Consultas')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Minhas Consultas</h1>
        <a href="/appointment/create" class="btn btn-success">
            <ion-icon name="add-outline"></ion-icon>
            Cadastrar Nova Consulta
        </a>
    </div>

    <div class="my-4">
        <h4>Buscar por Data</h4>
        <form action="/appointment/dashboard" method="GET">
            <div class="input-group">
                <input type="date" id="search" name="search" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
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
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td class="text-center">{{ $appointment->vets_name }}</td>
                            <td class="text-center">{{ date('d/m/Y H:i', strtotime($appointment->appointment_date)) }}</td>
                            <td class="text-center">
                                <a href="/appointment/edit/{{ $appointment->id }}" class="btn btn-info btn-sm edit-btn" title="Re-agendar">
                                    <ion-icon name="pencil-outline"></ion-icon> Re-agendar
                                </a>
                                <form action="/appointment/{{ $appointment->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn" title="Cancelar Consulta" onclick="return confirm('Tem certeza que deseja cancelar esta consulta?')">
                                        <ion-icon name="trash-outline"></ion-icon> Cancelar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        @if($search)
            <p>Nenhuma consulta encontrada para a data informada. <a href="/appointment/dashboard">Ver todas.</a></p>
        @else
            <p>Você ainda não tem nenhuma consulta agendada! <a href="/appointment/create">Agendar nova consulta.</a></p>
        @endif
    @endif
</div>

@endsection