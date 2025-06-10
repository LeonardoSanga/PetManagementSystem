@extends('layouts.main')

@section('title', 'Meus PETs')

@section('content')

    <div class="col-md-10 offset-md-1">
        <h1>Busque um Pet</h1>
        <form action="/dashboard" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procure um Pet">
            <input type="submit" value="Buscar">
        </form>
        <div class="row">
            @if(count($pets) > 0)
            <table>
            @foreach($pets as $pet)
                <tr>
                    <td><a href="/pets/edit/{{ $pet->id }}" class="btn btn-info edit-btn"><ion-icon name="pencil-outline"></ion-icon> Editar</a></td>
                    <td>
                        
                        <form action="/pets/{{ $pet->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    
                    </td>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->species }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td>{{ date('d/m/Y', strtotime($pet->birth_date)) }}</td>
                    <td><img src="/img/pets/{{ $pet->image }}" class="pet-dashboard-image" alt=""></td>
                </tr>
            @endforeach
            </table>
            @else
            <p>Você ainda não tem nenhum pet cadastrado no sistema</p>
            @endif
        </div>
    </div>

@endsection