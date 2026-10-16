<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'tbconsulta';
    protected $primaryKey = 'codConsulta';

    const CREATED_AT = 'dataCriacao';
    const UPDATED_AT = null;

    protected $fillable = [
        'nomeConsulta',
        'tipoConsulta',
        'statusConsulta',
        'dataHoraAgendada',
        'historicoConsulta',
        'codUsuario',
        'codProfissionalSaude',
    ];

    public const STATUS = [
        'aguardando' => 'Aguardando',
        'em_andamento' => 'Em andamento',
        'encerrada' => 'Encerrada',
        'cancelada' => 'Cancelada',
    ];

    public const TIPOS = [
        'agendada' => 'Consulta',
        'duvida_rapida' => 'Dúvida rápida',
    ];

    protected $casts = [
        'dataHoraAgendada' => 'datetime',
        'dataCriacao' => 'datetime',
    ];

    public function usuaria()
    {
        return $this->belongsTo(Usuario::class, 'codUsuario', 'codUsuario');
    }

    public function avaliacao()
    {
        return $this->hasOne(AvaliacaoConsulta::class, 'codConsulta', 'codConsulta');
    }
}
