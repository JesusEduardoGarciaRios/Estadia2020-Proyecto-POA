<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    // Función que muestra el formulario de login
    public function showLoginForm(){
        return view('auth.login');
    }

    // Función que contiene la lógica del login
    public function login(Request $request){
        // Validación de campos del formulario de login
        $request->validate([
            'email' => 'required|string',
            // 'usuario' => 'required|string',
            'password' => 'required|string'
        ]);
        // Se valida que las credenciales coincidan   
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            //Si las credenciales coinciden se redirecciona a la ruta del tablero
            return redirect('/main');
        }
        // Si hay un error se notifica en el formulario login al usuario
        return back()->withErrors(['email' => trans('auth.failed')])
                    ->withInput(request(['email']));
    }

    // Función para cerrar sesión
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
