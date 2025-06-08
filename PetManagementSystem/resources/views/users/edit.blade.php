@extends('layouts.main')

@section('title', 'Editando usuário')

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3" >
        <h1>Editando: {{ $user->name }}</h1>
        <form method="POST" action="/users/update/{{ $user->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="user_type">Tipo de usuário</label>
                <select name="user_type" id="user_type"  class="form-control">
                    <option value="0">Usuário comum</option>
                    <option value="1" {{ $user->user_type == 1 ? "selected='selected'" : "" }} >Usuário Administrador</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

            <input type="submit" class="btn btn-primary" value="Editar usuário">
        </form>
    </div>


@endsection