<?php
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TemaController;

Route::get('/', fn() => view('welcome'))->name('inicio');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [UsuarioController::class, 'login']);
Route::get('/logout', [UsuarioController::class, 'logout']);

Route::get('/penal', function () {
    $usuario = session('usuario');
    if (!$usuario) return redirect('/login');
    return "Bienvenido al sistema penal, $usuario";
});
use App\Models\Tema;
use Illuminate\Http\Request;

// Panel admin: listado de temas
Route::get('/admin', function () {
    if (session('usuario') !== 'admin') return redirect('/login');
    $temas = Tema::all();
    return view('admin.temas.index', compact('temas'));
})->name('admin.temas.index');

// Crear tema: formulario
Route::get('/admin/temas/crear', function () {
    if (session('usuario') !== 'admin') return redirect('/login');
    return view('admin.temas.create');
})->name('admin.temas.create');

// Guardar tema
Route::post('/admin/temas', function(Request $request){
    if (session('usuario') !== 'admin') return redirect('/login');

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

    return redirect()->route('admin.temas.index');
})->name('admin.temas.store');

// Editar tema: formulario
Route::get('/admin/temas/{tema}/editar', function(Tema $tema){
    if (session('usuario') !== 'admin') return redirect('/login');
    return view('admin.temas.edit', compact('tema'));
})->name('admin.temas.edit');

// Actualizar tema
Route::post('/admin/temas/{tema}', function(Request $request, Tema $tema){
    if (session('usuario') !== 'admin') return redirect('/login');

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

    $tema->update($data);

    return redirect()->route('admin.temas.index');
})->name('admin.temas.update');

// Borrar tema
Route::delete('/admin/temas/{tema}', function(Tema $tema){
    if(session('usuario') !== 'admin') return redirect('/login');
    $tema->delete();
    return redirect()->route('admin.temas.index')->with('success','Tema eliminado correctamente.');
})->name('admin.temas.destroy');
// Logout
Route::get('/logout', function() {
    session()->flush();
    return redirect('/login');
});



// Página de Conceptos Fundamentales
Route::get('/penal/conceptos', function () {
    return view('penal.conceptos'); // resources/views/penal/conceptos.blade.php
})->name('conceptos');
// Página de  El Código Penal y los Tipos de Delitos
Route::get('/penal/clasificacion', function () {
    return view('penal.clasificacion'); // resources/views/penal/conceptos.blade.php
})->name('clasificacion');
// Página de  El Código Penal y los Tipos de Delitos
Route::get('/penal/proceso', function () {
    return view('penal.proceso'); // resources/views/penal/proceso.blade.php
})->name('proceso');
// Página de  Críticas y Desafíos del Sistema Penal Argentino
Route::get('/penal/sistema', function () {
    return view('penal.sistema'); // resources/views/penal/sistema.blade.php
})->name('sistema');
// Página de  Clasificaciones Adicionales y Ejemplos de Aplicación
Route::get('/penal/adicional', function () {
    return view('penal.adicional'); // resources/views/penal/adicional.blade.php
})->name('adicional');
?>
