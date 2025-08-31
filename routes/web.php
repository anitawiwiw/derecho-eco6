<?php
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return view('penal.index'); 
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
