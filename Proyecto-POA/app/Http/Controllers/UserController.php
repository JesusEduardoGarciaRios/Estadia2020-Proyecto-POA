<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    //Función que muestra el contenido del data table
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $users = User::select('users.id', 'users.rol', 'users.nombre', 'users.email', 'users.password')
                        ->where('users.rol', 'Administrador')
                        ->orderBy('users.id', 'desc')->paginate(2);
        return [
            'pagination' => [
                'total'        => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'     => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
            ],
            'users' => $users
        ];
    }

    //Función que contiene la lógica para almacenar un usuario
    public function store(Request $request)
    {   
        if(!$request->ajax()) return redirect('/');
        $user = new User();
        $user->rol = 'Administrador';
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    }

    //Función que contiene la lógica para actualizar un usuario
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
    }

    //Función que contiene la lógica para eliminar un usuario
    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->delete();
    }
}
