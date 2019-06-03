<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
            'column-1'=>'id',
            'column-2'=>'nombre',
            'column-3'=>'correo',
            'column-4'=>'celular',
            'column-5'=>'fecha_nacimiento',
            'column-6'=>'tipo_scharfer',
            'column-7'=>'created_at',
        ];

        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }



        $model = Postulante::where(function ($query) use ($search){
            $query->where( 'nombre','like','%'.$search.'%');
            $query->orWhere( 'apellidos','like','%'.$search.'%');
            $query->orWhere( 'correo','like','%'.$search.'%');
            $query->orWhere( 'celular','like','%'.$search.'%');
        });

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

    public function tipos_scharfer_ar(){
      return [
        '1'=>'Bicicleta',
        '2'=>'Moto',
        '3'=>'Auto',
        '4'=>'Scharffer'
      ];

    }


    public function tipo_scharfer(){

      switch ($this->tipo_scharfer) {
        case 1:
          $cadena = 'Bicicleta';
          break;
        case 2:
          $cadena = 'Moto';
          break;
        case 3:
          $cadena = 'Auto';
          break;
        default:
        $cadena = 'Scharffer';
          break;
      }
      return $cadena;
    }
}
