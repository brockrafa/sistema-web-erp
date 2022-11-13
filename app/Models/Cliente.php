<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $fillable = ['documento','nome','cep','cidade','bairro','sexo','data_nascimento','uf','logradouro'];
}
