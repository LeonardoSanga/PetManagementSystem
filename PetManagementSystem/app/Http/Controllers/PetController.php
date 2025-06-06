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


        $pet->save();

        return redirect('/')->with('msg', 'Pet cadastrado com sucesso!');

    }
}
