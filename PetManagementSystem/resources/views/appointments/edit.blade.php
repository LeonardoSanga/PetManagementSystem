@extends('layouts.main')

@section('title', 'Editando usuário')

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3" >
        <h1>Editando a consulta</h1>
        <form method="POST" action="/appointment/update/{{ $appointment->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="vets_name">Nome do veterinário:</label>
                <input type="text" class="form-control" id="vets_name" name="vets_name" value="{{ $appointment->vets_name }}">
            </div>

            <div class="form-group">
                <label for="pet_id">Qual o Pet?</label>
                <select name="pet_id" id="pet_id"  class="form-control">
                    @foreach($pets as $pet)
                        <option value="{{ $pet->id }}" {{ $appointment->pet_id == $pet->id ? "selected='selected'" : "" }} >{{ $pet->name }} | {{ $pet->species }} | {{ $pet->breed }} |  {{ date('d/m/Y', strtotime($pet->birth_date)) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="appointment_date">Data da consulta:</label>
                <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}">
            </div>

            <div class="form-group">
                <label for="description">Breve descrição do problema:</label>
            <textarea name="description" id="description" class="form-control">{{ $appointment->description }}</textarea>
        </div>

            <input type="submit" class="btn btn-primary" value="Editar pet">
        </form>
    </div>


@endsection