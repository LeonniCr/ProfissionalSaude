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
        Schema::create('tbProfissional', function (Blueprint $table) {
            $table->id();
            $table->string('nomeProfissional');
            $table->string('emailProfissional');
            $table->string('cpfProfissional');
            $table->string('telefoneProfissional');
            $table->date('dataNascProfissional');
            $table->string('senhaProfissional');
            $table->string('categoriaProfissional');
            $table->string('especialidadeProfissional');
            $table->string('conselhoClasseProfissional');
            $table->string('numConselhoProfissional');
            $table->string('ufConselhoProfissional');
            $table->string('comprovanteConselhoProfissional');
            $table->string('docComplementarProfissional');
            $table->string('apresentacaoProfissional')->nullable();
            $table->string('fotoPerfilProfissional')->nullable();
            $table->boolean('atendeChatProfissional');
            $table->boolean('atendeDuvidaRapidoProfissional');
            $table->boolean('atendePresencialProfissional');
            $table->string('statusVerificacaoProfissional')->nullable();
            $table->string('statusContaProfissional')->nullable();
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbProfissional');
    }
};
