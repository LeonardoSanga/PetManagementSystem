<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\Pet;

class AppointmentController extends Controller
{
    public function create() {
        $pets = Pet::all();

        return view('appointments.create', ['pets' => $pets]);
    }

    public function store(Request $request) {
        $appointment = new Appointment;

        $appointment->appointment_date = $request->date;
        $appointment->vets_name = $request->vets_name;
        $appointment->description = $request->description;
        $appointment->pet_id = $request->pet_id;

        $user = auth()->user();
        $appointment->user_id = $user->id;

        $appointment->save();

        return redirect('/')->with('msg', 'Consulta agendada com sucesso!');
    }

    public function dashboard() {
        $user_id = auth()->user()->id;

        if(auth()->user()->user_type == 1) {
            $appointments = Appointment::all();
        } else {
            $appointments = Appointment::where('user_id', $user_id)->get();
        }

        return view('appointments.dashboard', ['appointments' => $appointments]);
    }

    public function destroy($id) {
        Appointment::findOrFail($id)->delete();

        return redirect('/appointment/dashboard')->with('msg', 'Consulta cancelada com sucesso!');
    }

    public function edit($id) {
        $appointment = Appointment::findOrFail($id);

         $pets = Pet::all();

        return view('appointments.edit', ['appointment' => $appointment, 'pets' => $pets]);
    }

    public function update(Request $request) {
        $date = $request->all();

        Appointment::findOrFail($request->id)->update($date);

        return redirect('/appointment/dashboard')->with('msg', 'Consulta alterado com sucesso!');
    }
}
