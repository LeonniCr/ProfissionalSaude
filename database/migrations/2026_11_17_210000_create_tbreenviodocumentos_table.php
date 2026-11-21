<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Esta migration existe igual nos dois projetos (admin e profissional), que usam o mesmo banco.
// O hasTable evita erro se ela já tiver sido executada pelo outro projeto.
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('tbReenvioDocumentos')) {
            return;
        }

        Schema::create('tbReenvioDocumentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codProfissionalSaude');
            $table->string('chave', 64)->unique();
            // Documentos pedidos, separados por vírgula: foto, complementar, comprovante
            $table->string('documentos', 100);
            $table->timestamps();

            $table->index('codProfissionalSaude');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbReenvioDocumentos');
    }
};
