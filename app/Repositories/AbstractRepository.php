<?php

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository{

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function filtro($f){
        $filtros = explode(';',$f);
        foreach($filtros as $key => $filtro){
            $c = explode(":",$filtro);
            if(count($c) != 3){
                return response()->json(['status'=>'erro','mensagem' => 'Verifique o formato do filtro e tente novamente'],501);
            }
            $this->model = $this->model->where($c[0],$c[1],$c[2]);
        }
    }

    public function selectAtributtes($atributos){
        $this->model = $this->model->selectRaw('id,'.$atributos);
    }

    public function getResults($idEmpresa){
        return $this->model->where("id_empresa",$idEmpresa)->get();
    }

}




?>