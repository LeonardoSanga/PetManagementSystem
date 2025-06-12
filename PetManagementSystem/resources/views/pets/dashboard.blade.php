@extends('layouts.main')

@section('title', 'Meus PETs')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Meus PETs</h1>
        <a href="/pets/create" class="btn btn-success">
            <ion-icon name="add-outline"></ion-icon>
            Cadastrar Novo PET
        </a>
    </div>

    <div class="my-4">
        <h4>Busque um Pet</h4>
        <form action="/dashboard" method="GET">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Procure pelo nome do Pet...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    @if(count($pets) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Imagem</th>
                        <th scope="col" class="text-center">Nome</th>
                        <th scope="col" class="text-center">Espécie</th>
                        <th scope="col" class="text-center">Raça</th>
                        <th scope="col" class="text-center">Nascimento</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pets as $pet)
                        <tr>
                            <td class="text-center"><img src="/img/pets/{{ $pet->image }}" class="pet-dashboard-image" alt="Foto de {{ $pet->name }}"></td>
                            <td class="text-center">{{ $pet->name }}</td>
                            <td class="text-center">{{ $pet->species }}</td>
                            <td class="text-center">{{ $pet->breed }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($pet->birth_date)) }}</td>
                            <td class="text-center">
                                <a href="/pets/edit/{{ $pet->id }}" class="btn btn-info btn-sm edit-btn" title="Editar">
                                    <ion-icon name="pencil-outline"></ion-icon> Editar
                                </a>
                                <form action="/pets/{{ $pet->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn" title="Deletar" onclick="return confirm('Tem certeza que deseja deletar este PET?')">
                                        <ion-icon name="trash-outline"></ion-icon> Deletar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        @if($search ?? false)
            <p>Nenhum pet encontrado com o nome "{{ $search }}". <a href="/dashboard">Ver todos.</a></p>
        @else
            
        @endif
    @endif
</div>

@endsection