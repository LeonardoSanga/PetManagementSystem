@extends('layouts.main')

@section('title', 'Gerenciar Usuários')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-container">
    <h1>Usuários do Sistema</h1>

    <div class="my-4">
        <h4>Busque um usuário</h4>
        <form action="/users" method="GET">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Procure por nome ou e-mail...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    {{-- A contagem de usuários para a verificação deve ser feita no Controller --}}
    {{-- Para o Blade, vamos assumir que $users contém apenas os usuários a serem exibidos --}}
    @if(count($users) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover align-middle">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">Nome</th>
                        <th scope="col" class="text-center">E-mail</th>
                        <th scope="col" class="text-center">Tipo</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        {{-- A filtragem por user_type idealmente deve ser feita no Controller --}}
                        {{-- Mas mantendo a lógica original do seu template: --}}
                        @if($user->user_type == 0) 
                            <tr>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    @if($user->user_type == 0)
                                        <span class="badge bg-secondary">Comum</span>
                                    @else
                                        {{-- Este bloco não será executado por causa do if externo --}}
                                        <span class="badge bg-primary">Administrador</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="/users/edit/{{ $user->id }}" class="btn btn-info btn-sm edit-btn" title="Editar">
                                        <ion-icon name="pencil-outline"></ion-icon> Editar
                                    </a>
                                    <form action="/users/{{ $user->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn" title="Deletar" onclick="return confirm('Tem certeza que deseja deletar este usuário?')">
                                            <ion-icon name="trash-outline"></ion-icon> Deletar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        @if($search)
            <p>Nenhum usuário encontrado com o termo "{{ $search }}". <a href="/users">Ver todos.</a></p>
        @else
            <p>Não há usuários cadastrados no sistema.</p>
        @endif
    @endif
</div>

@endsection