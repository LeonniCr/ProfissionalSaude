<?php

namespace Database\Seeders;

use App\Models\TipoCategoria;
use App\Models\TipoConteudo;
use Illuminate\Database\Seeder;

class ConteudoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Gravidez', 'ISTs', 'Direitos', 'Contraceptivos', 'Corpo', 'Saúde mental', 'Rede de Apoio'] as $nome) {
            TipoCategoria::firstOrCreate(['nomeTipoCategoria' => $nome]);
        }

        foreach (['Artigo', 'Vídeo', 'Infográfico'] as $descricao) {
            TipoConteudo::firstOrCreate(['descricaoTipoConteudo' => $descricao]);
        }
    }
}
