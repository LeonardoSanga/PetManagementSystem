<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pet;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
   public function index()
    {
        // Verifica primeiro se o usuário está logado
        if (!Auth::check()) {
            // Se não estiver, redireciona para a página de login
            return redirect('/login');
        }

        // Se o código chegou até aqui, significa que o usuário está logado.
        // O resto do seu código pode continuar como antes.
        $user = Auth::user();
        $pets = Pet::where('user_id', $user->id)->get();

        $appointments = Appointment::whereIn('pet_id', $pets->pluck('id'))
                                     ->where('appointment_date', '>=', now())
                                     ->orderBy('appointment_date', 'asc')
                                     ->get();

        return view('welcome', [
            'pets'         => $pets,
            'appointments' => $appointments
        ]);
    }
}
