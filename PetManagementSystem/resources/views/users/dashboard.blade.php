@extends('layouts.main')

@section('title', 'Meus PETs')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <table>
            @foreach($users as $user)
                @if($user->user_type == 0) 
                <tr>
                    <td><a href="/users/edit/{{ $user->id }}" class="btn btn-info edit-btn"><ion-icon name="pencil-outline"></ion-icon> Editar</a></td>
                    <td>
                        
                        <form action="/users/{{ $user->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td> 
                        @if($user->user_type == 0 )
                            Comum
                        @else
                            Administrador
                        @endif
                    </td>
                </tr>
                @endif
            @endforeach
            </table>
        </div>
    </div>

@endsection