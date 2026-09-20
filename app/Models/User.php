<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'tbProfissional';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nomeProfissional',
        'emailProfissional',
        'cpfProfissional',
        'telefoneProfissional',
        'dataNascProfissional',
        'senhaProfissional',
        'categoriaProfissional',
        'especialidadeProfissional',
        'conselhoClasseProfissional',
        'numConselhoProfissional',
        'ufConselhoProfissional',
        'comprovanteConselhoProfissional',
        'docComplementarProfissional',
        'apresentacaoProfissional',
        'fotoPerfilProfissional',
        'atendeChatProfissional',
        'atendeDuvidaRapidoProfissional',
        'atendePresencialProfissional',
        'statusVerificacaoProfissional',
        'statusContaProfissional',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'senhaProfissional',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
}
