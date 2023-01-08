<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Chamado extends Model
{
    use HasFactory;
    public $fillable = ['id_cliente','id_empresa','data_abertura','titulo','setor','tipo_problema','prioridade','id_responsavel','id_status_chamado','contrato','problema'];
   
    public function cliente(){
        return $this->hasOne(Cliente::class,'id','id_cliente');
    }
    public function statusChamado(){
        return $this->hasOne(StatusChamado::class,'id','id_status_chamado');
    }
    public function responsavel(){
        return $this->hasOne(Usuario::class,'id','id_responsavel');
    }
}
