<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalhesChamado extends Model
{
    use HasFactory;

    protected $fillable = ['update_descricao','id_chamado','id_usuario'];
    
    public function chamado(){
        return $this->hasOne(Chamado::class,'id','id_chamado');
    }
    public function usuario(){
        return $this->hasOne(Usuario::class,'id','id_usuario');
    }
}
