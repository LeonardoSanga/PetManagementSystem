<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pet;

class PetController extends Controller
{
    public function index() {

        $pets = Pet::all();

        return view('welcome', ['pets' => $pets]);
    }

    public function create() {
        return view('pets.create');
    }

    public function store(Request $request) {

        $pet = new Pet;

        $pet->name = $request->name;
        $pet->species = $request->species;
        $pet->breed = $request->breed;
        $pet->birth_date = $request->birth_date;
        $pet->image = $request->image;

        /* Image Upload */
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/pets'), $imageName);

            $pet->image = $imageName;
             
        }

        $user = auth()->user();
        $pet->user_id = $user->id;

        $pet->save();

        return redirect('/')->with('msg', 'Pet cadastrado com sucesso!');

    }

    public function dashboard() {

        $user_id = auth()->user()->id;
        
        if(auth()->user()->user_type == 1) {
            $pets = Pet::all();
        } else {
            $pets = Pet::where('user_id', $user_id)->get();
        }

        return view('pets.dashboard', ['pets' => $pets]);

    }

    public function destroy($id) {

        Pet::findOrFail($id)->delete();

        return redirect('/pets')->with('msg', 'Pet excluído com sucesso!');

    }

    public function edit($id) {
        $pet = Pet::findOrFail($id);

        return view('pets.edit', ['pet' => $pet]);
    }

    public function update(Request $request) {


        $date = $request->all();

        Pet::findOrFail($request->id)->update($date);

        return redirect('/pets')->with('msg', 'Pet alterado com sucesso!');

    }
}
