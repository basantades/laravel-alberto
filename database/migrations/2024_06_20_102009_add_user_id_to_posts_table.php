<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image')->nullable(); // Añadimos la columna para la imagen, puede ser nula
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Añadimos la columna para el ID del usuario como clave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};


