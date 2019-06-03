<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claimbook extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
            'column-1'=>'numero_reclamo',
            'column-2'=>'nombre',
            'column-3'=>'documento',
            'column-4'=>'created_at'
        ];

        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }

        $model = Claimbook::where(function ($query) use ($search){
            $query->where( 'numero_reclamo','like','%'.$search.'%');
            $query->orWhere( 'nombre','like','%'.$search.'%');
            $query->orWhere( 'documento','like','%'.$search.'%');

        })->where('estado_reclamo',1);


        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
          $model->whereBetween('created_at', array($fecha_inicio,$fecha_fin));
        }

        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('id','desc')->paginate($pager);
        return $model;
    }

    public function ubigeo(){
        return $this->belongsTo(Ubigeo::class);
    }

    public function obtenerLineaServicio(){
        $key = $this->linea_servicio;
        if ($key == 'distribución-nacional'){
            return 'Distribución Nacional';
        } elseif ($key == 'aduanas') {
            return 'Aduanas';
        }elseif ($key == 'carga'){
            return 'Carga';
        }elseif ($key == 'almacenes') {
            return 'Almacenes';
        } elseif ($key == 'envios-internacionales'){
            return 'Envíos Internacionales';
        } elseif ($key == 'scharff-express-pickapp'){
            return 'Scharff Express';
        }elseif ($key == 'scharff-stop-lockers') {
            return 'Scharff Stop';
        }
        return '';

    }
}
