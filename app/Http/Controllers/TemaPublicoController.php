<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tema;

class TemaPublicoController extends Controller
{
    // Vista principal con buscador
    public function index() {
        return view('penal.index');
    }

    // Búsqueda por palabras en título o preguntas
    public function buscar(Request $request) {
        $query = $request->input('q');
        if(!$query) return redirect()->route('penal.index');

        $palabras = preg_split('/\s+/', $query);

        $resultados = Tema::where(function($q) use ($palabras) {
            foreach($palabras as $palabra) {
                $q->orWhere('titulo', 'like', "%$palabra%")
                  ->orWhere('preguntas', 'like', "%$palabra%");
            }
        })->get();

        return view('penal.resultados', compact('resultados', 'query'));
    }

    // Ver tema completo
    public function ver($id) {
        $tema = Tema::findOrFail($id);
        return view('penal.ver', compact('tema'));
    }
}
