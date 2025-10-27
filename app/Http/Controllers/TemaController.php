<?php

// app/Http/Controllers/Admin/TemaController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tema;
use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function index() {
        $temas = Tema::latest()->get();
        return view('admin.temas.index', compact('temas'));
    }

    public function create() {
        return view('admin.temas.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'preguntas' => 'required|string',
            'informacion' => 'nullable|string',
            'link' => 'nullable|url',
            'documento' => 'nullable|file|mimes:pdf,doc,docx'
        ]);

        if ($request->hasFile('documento')) {
            $data['documento'] = $request->file('documento')->store('documentos', 'public');
        }

        Tema::create($data);

        return redirect()->route('admin.temas.index')->with('success', 'Tema creado correctamente.');
    }
    
}

