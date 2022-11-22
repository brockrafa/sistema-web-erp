<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContasReceber extends Model
{
    use HasFactory;
    protected $table = 'contas_receber';

    public function venda(){
        return $this->hasOne(Venda::class,'id','venda_id');
    }

}
