<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;   // ✅ ESTA LÍNEA ES CLAVE

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nombre' => 'Admin',
            'email' => 'admin@penal.com',
            'password' => Hash::make('admin123'),
            'es_admin' => true,
        ]);


    }
}
