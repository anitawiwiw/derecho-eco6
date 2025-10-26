<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function mostrarLogin() {
        return view('login');
    }

public function login(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Si es el admin
    if ($request->email === 'admin@penal.com' && $request->password === 'admin123') {
        // Crear sesión del admin
        session(['usuario' => 'admin']);
        return redirect('/admin');
    }

    // Para cualquier otro email
    session(['usuario' => $request->email]); // guardamos el email en sesión
    return redirect('/penal');
}

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
    protected function authenticated($request, $user)
{
    if ($user->email === 'admin@penal.com') {
        return redirect('/admin');
    }

    return redirect('/penal');
}

}

