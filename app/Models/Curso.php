<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'duracao',
        'preco',
        'imagem',
    ];

    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class);
    }
}
