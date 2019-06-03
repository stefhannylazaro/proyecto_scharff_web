<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogTransaction extends Model
{
    //protected $connection = 'pickapp_api';
    protected $guarded = [];

    protected $table = 'log_transaction';

    public static function search($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
          'column-1' =>'id',
          'column-2' =>'customer_id',
          'column-3' =>'tipo_accion',
          'column-4' =>'trama_respuesta_culqi',
          'column-5' =>'created_at',
        ];


        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }



        $model = LogTransaction::where(function ($query) use ($search){
            $query->where( 'id','like','%'.$search.'%');
            $query->orWhere( 'tipo_accion','like','%'.$search.'%');
            $query->orWhere( 'trama_respuesta_culqi','like','%'.$search.'%');
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




}
