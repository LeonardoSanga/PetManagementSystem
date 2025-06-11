@extends('layouts.main')

@section('title', 'Minhas Consultas')

@section('content')

    <div class="col-md-10 offset-md-1">
        <h1>Busque uma consulta</h1>
        <form action="/appointment/dashboard" method="GET">
            <input type="date" id="search" name="search" class="form-control" placeholder="Procure um Pet">
            <input type="submit" value="Buscar">
        </form>

        <div class="row">
            @if(count($appointments) > 0)
            <table>
            @foreach($appointments as $appointment)
                <tr>
                    <td><a href="/appointment/edit/{{ $appointment->id }}" class="btn btn-info edit-btn"><ion-icon name="pencil-outline"></ion-icon> Re-agendar</a></td>
                    <td>
                        
                        <form action="/appointment/{{ $appointment->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Cancelar</button>
                        </form>
                    
                    </td>
                    <td>{{ $appointment->vets_name }}</td>
                    <td>{{ date('d/m/Y  H:i', strtotime($appointment->appointment_date)) }}</td>
                    <!-- <td><img src="/img/pets/" class="pet-dashboard-image" alt=""></td> -->
                </tr>
            @endforeach
            </table>
            @else
            <p>Você ainda não tem nenhuma consulta agendada!</p>
            @endif
        </div>
    </div>

@endsection