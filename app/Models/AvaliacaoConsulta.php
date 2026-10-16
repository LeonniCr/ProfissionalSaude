<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvaliacaoConsulta extends Model
{
    protected $table = 'tbavaliacaoconsulta';
    protected $primaryKey = 'codConsulta';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['codConsulta', 'nota', 'comentario'];
}
