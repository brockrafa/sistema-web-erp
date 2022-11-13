<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecuperarSenha extends Model
{
    use HasFactory;

    protected $fillable = ['token','email'];

}
