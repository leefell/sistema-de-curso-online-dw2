<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = 'inscricoes';

    protected $fillable = [
        'curso_id',
        // 'user_id', // Se aplicável
        'data_inscricao',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    // public function user() // Se aplicável
    // {
    //     return $this->belongsTo(User::class);
    // }
}
