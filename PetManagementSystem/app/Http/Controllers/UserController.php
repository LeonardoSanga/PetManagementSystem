<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function dashboard() {

        $search = request('search');

        if($search) {

            $users = User::where([
                ['name', 'like', '%'.$search.'%']
            ])->get();

        } else {

            $users = User::all();

        }

        return view('users.dashboard', ['users' => $users]);
    }

    public function destroy($id) {

        User::findOrFail($id)->delete();

        return redirect('/users')->with('msg', 'Usuário excluído com sucesso!');

    }

    public function edit($id) {
        $user = User::findOrFail($id);

        return view('users/edit', ['user' => $user]);
    }

    public function update(Request $request) {


        $date = $request->all();

        User::findOrFail($request->id)->update($date);

        return redirect('/users')->with('msg', 'Usuário alterado com sucesso!');

    }
}
