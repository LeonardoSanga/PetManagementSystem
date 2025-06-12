<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        // Verifica se o usuário está logado. Se não, redireciona.
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Se chegou aqui, o usuário está logado.
        $user = Auth::user();

        // 1. Busca os pets do usuário logado (esta parte continua igual e está correta).
        $pets = Pet::where('user_id', $user->id)->get();

        // 2. CORREÇÃO COM BASE NA SUA TABELA:
        // Buscamos as consultas onde a coluna 'cliente_id' é igual ao ID do usuário logado.
        $appointments = Appointment::where('cliente_id', $user->id)
                                     ->where('appointment_date', '>=', now()) // Continua pegando só as futuras
                                     ->orderBy('appointment_date', 'asc')    // E ordenando
                                     ->get();

        // 3. Envia as duas coleções (pets e appointments) para a view.
        return view('welcome', [
            'pets'         => $pets,
            'appointments' => $appointments
        ]);
    }
}