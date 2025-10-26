<?php
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('inicio');
Route::get('/login', [UsuarioController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [UsuarioController::class, 'login']);
Route::get('/logout', [UsuarioController::class, 'logout']);

Route::get('/penal', function () {
    $usuario = session('usuario');
    if (!$usuario) return redirect('/login');
    return "Bienvenido al sistema penal, $usuario";
});

Route::get('/admin', function () {
    if (session('usuario') !== 'admin') return redirect('/login');
    return 'Bienvenido, administrador';
});

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
