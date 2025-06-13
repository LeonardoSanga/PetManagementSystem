<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pet;

class PetController extends Controller
{

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {

        $pet = new Pet;

        $pet->name = $request->name;
        $pet->species = $request->species;
        $pet->breed = $request->breed;
        $pet->birth_date = $request->birth_date;
        $pet->image = $request->image;

        /* Image Upload */
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/pets'), $imageName);

            $pet->image = $imageName;
        }

        $user = auth()->user();
        $pet->user_id = $user->id;

        $pet->save();

        return redirect('/dashboard')->with('msg', 'Pet cadastrado com sucesso!');
    }

    public function dashboard()
    {

        $user_id = auth()->user()->id;
        $search = request('search');

        if ((auth()->user()->user_type == 1) && !$search) {

            $pets = Pet::all();
        } else if ((auth()->user()->user_type == 1) && $search) {

            $pets = Pet::where([
                ['name', 'like', '%' . $search . '%']
            ])->get();
        } else if ((auth()->user()->user_type == 0) && !$search) {

            $pets = Pet::where('user_id', $user_id)->get();
        } else {

            $pets = Pet::where('user_id', $user_id)->where('name', 'like', '%' . $search . '%')->get();
        }

        return view('pets.dashboard', ['pets' => $pets]);
    }

    public function destroy($id)
    {
        // Apenas busca o pet pelo ID, sem verificar o dono.
        $pet = Pet::findOrFail($id);

        try {
            $pet->delete();
            return redirect('/dashboard')->with('msg', 'Pet excluído com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Este pet não pode ser excluído, pois possui consultas associadas.');
        }
    }
    public function edit($id)
    {
        $pet = Pet::findOrFail($id);

        return view('pets.edit', ['pet' => $pet]);
    }

    public function update(Request $request)
    {
 
        

        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/pets'), $imageName);

            $data['image'] = $imageName;
        }


        Pet::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Pet alterado com sucesso!');
    }
}
