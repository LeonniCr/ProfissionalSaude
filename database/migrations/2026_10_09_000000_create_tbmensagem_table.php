<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbmensagem', function (Blueprint $table) {
            $table->id('codMensagem');
            $table->unsignedBigInteger('codRemetente');
            $table->unsignedBigInteger('codDestinatario');
            $table->text('textoMensagem');
            $table->boolean('lidaMensagem')->default(false);
            $table->timestamp('dataEnvio')->useCurrent();

            $table->index(['codRemetente', 'codDestinatario']);
            $table->foreign('codRemetente')->references('codProfissionalSaude')->on('tbprofissionalsaude')->cascadeOnDelete();
            $table->foreign('codDestinatario')->references('codProfissionalSaude')->on('tbprofissionalsaude')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbmensagem');
    }
};