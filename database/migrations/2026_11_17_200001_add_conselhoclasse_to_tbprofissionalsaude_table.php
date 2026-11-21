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
        // Conselho de classe do profissional (ex.: CRM, CRP, COREN).
        // Fica vazio nos cadastros que já existem, por isso é nullable.
        Schema::table('tbprofissionalsaude', function (Blueprint $table) {
            $table->string('conselhoClasseProfissionalSaude', 50)->nullable()->after('especialidadeProfissionalSaude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbprofissionalsaude', function (Blueprint $table) {
            $table->dropColumn('conselhoClasseProfissionalSaude');
        });
    }
};
