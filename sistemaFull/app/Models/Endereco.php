<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'bairro',
        'estado',
        'pais',
        'cep'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
