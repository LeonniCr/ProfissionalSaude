<?php

namespace Database\Seeders;

use App\Models\DataSaude;
use App\Models\TipoCategoria;
use Illuminate\Database\Seeder;

class DataSaudeSeeder extends Seeder
{
    public function run(): void
    {
        // [mês, dia (null = mês inteiro), nome, cor, categoria (de tbtipocategoria), pauta]
        $datas = [
            [1, null, 'Janeiro Branco', '#8a7680', 'Saúde mental', 'Cuidado com a saúde mental: sinais de alerta, rotina de autocuidado e quando buscar ajuda profissional.'],
            [2, 4, 'Dia Mundial contra o Câncer', '#d9731a', 'Corpo', 'Prevenção e rastreamento: quais exames fazer e a partir de que idade.'],
            [3, 8, 'Dia Internacional da Mulher', '#7c3aed', 'Direitos', 'Direitos e acesso à saúde da mulher em cada fase da vida.'],
            [3, null, 'Março Lilás', '#7c3aed', 'Corpo', 'Câncer do colo do útero: Papanicolau, vacina contra o HPV e a frequência dos exames.'],
            [4, 7, 'Dia Mundial da Saúde', '#0e7fb8', 'Corpo', 'Um hábito simples de cuidado preventivo para incluir na rotina.'],
            [5, 28, 'Dia Internacional de Ação pela Saúde da Mulher', '#d6336c', 'Direitos', 'Consultas de rotina, pré-natal e saúde sexual: direitos e cuidados.'],
            [5, 28, 'Dia da Higiene Menstrual', '#c92a2a', 'Corpo', 'Ciclo menstrual: o que é esperado e quando procurar ajuda.'],
            [7, null, 'Julho Amarelo', '#d9a406', 'ISTs', 'Hepatites virais: formas de transmissão, testagem e vacinação.'],
            [8, null, 'Agosto Lilás', '#7c3aed', 'Rede de Apoio', 'Violência contra a mulher: tipos de violência, sinais e canais de apoio.'],
            [8, null, 'Agosto Dourado', '#b7791f', 'Gravidez', 'Amamentação: benefícios, dificuldades comuns e como buscar apoio.'],
            [9, null, 'Setembro Amarelo', '#d9a406', 'Saúde mental', 'Prevenção do suicídio: como acolher, sinais de alerta e onde encontrar ajuda.'],
            [9, 26, 'Dia Mundial da Contracepção', '#0f9d8a', 'Contraceptivos', 'Métodos contraceptivos: como funcionam, quais existem e como escolher com acompanhamento.'],
            [10, null, 'Outubro Rosa', '#d6336c', 'Corpo', 'Câncer de mama: autoexame, mamografia e quando procurar atendimento.'],
            [10, 10, 'Dia Mundial da Saúde Mental', '#0f9d8a', 'Saúde mental', 'Ansiedade e estresse no dia a dia: estratégias práticas de cuidado.'],
            [11, null, 'Novembro Azul', '#2b6cb0', 'Corpo', 'Saúde do homem: prevenção do câncer de próstata e check-up de rotina.'],
            [11, 25, 'Dia Internacional da Eliminação da Violência contra a Mulher', '#7c3aed', 'Rede de Apoio', 'Como reconhecer relacionamentos abusivos e buscar proteção.'],
            [12, null, 'Dezembro Vermelho', '#c92a2a', 'ISTs', 'HIV/Aids e outras ISTs: prevenção, testagem e tratamento.'],
            [12, 1, 'Dia Mundial de Luta contra a Aids', '#c92a2a', 'ISTs', 'Testagem rápida, PrEP e PEP: o que são e onde conseguir.'],
        ];

        foreach ($datas as [$mes, $dia, $nome, $cor, $categoria, $pauta]) {
            $cod = TipoCategoria::firstOrCreate(['nomeTipoCategoria' => $categoria])->codTipoCategoria;

            DataSaude::updateOrCreate(
                ['nomeDataSaude' => $nome],
                [
                    'mesDataSaude' => $mes,
                    'diaDataSaude' => $dia,
                    'corDataSaude' => $cor,
                    'pautaDataSaude' => $pauta,
                    'codTipoCategoria' => $cod,
                ]
            );
        }
    }
}
