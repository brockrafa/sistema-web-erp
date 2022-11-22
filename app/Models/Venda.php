<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    public function cliente(){
        return $this->hasOne(Cliente::class,'id','cliente_id');
    }
}
