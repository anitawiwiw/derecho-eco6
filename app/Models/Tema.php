<?php

namespace App\Models;
// app/Models/Tema.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model {
    use HasFactory;

    protected $fillable = [
        'titulo',
        'preguntas',
        'informacion',
        'link',
        'documento'
    ];
        use HasFactory;

    protected $table = 'temas'; // tu tabla de temas
}

