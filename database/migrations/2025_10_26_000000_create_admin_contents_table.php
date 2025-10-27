<?php
// database/migrations/2025_10_26_000001_create_temas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('temas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('preguntas');
            $table->text('informacion')->nullable();
            $table->string('link')->nullable();
            $table->string('documento')->nullable(); // ruta del archivo
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('temas');
    }
};
