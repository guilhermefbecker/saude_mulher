<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Artigo extends Model
{
    protected $table = 'artigos';

    protected $fillable = [
        'titulo',
        'conteudo',
        'imagem',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}