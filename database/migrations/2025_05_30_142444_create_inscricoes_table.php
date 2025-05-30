<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade'); // Chave estrangeira para cursos
            // Adicione user_id se as inscrições forem por usuário autenticado
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('data_inscricao');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
