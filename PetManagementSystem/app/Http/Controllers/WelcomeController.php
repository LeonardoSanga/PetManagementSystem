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
        // 1. Primeiro, pegamos o usuário que está logado no sistema.
        $user = Auth::user();

        // 2. Usamos o ID dele para buscar APENAS os pets que pertencem a ele.
        $pets = Pet::where('user_id', $user->id)->get();

        
        $appointments = Appointment::whereIn('pet_id', $pets->pluck('id'))
            ->where('appointment_date', '>=', now())
            ->orderBy('appointment_date', 'asc')
            ->get();

        
        return view('welcome', [
            'pets'         => $pets,
            'appointments' => $appointments // << A variável que faltava agora está sendo enviada!
        ]);
    }
}
