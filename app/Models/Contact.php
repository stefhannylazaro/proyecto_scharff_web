<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
            'column-1'=>'empresa',
            'column-2'=>'nombre',
            'column-3'=>'correo',
            'column-4'=>'created_at',
            'column-5'=>'motivo',
            'column-6'=>'servicios'
        ];

        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }


        $model = Contact::where(function ($query) use ($search){
            $query->where( 'empresa','like','%'.$search.'%');
            $query->orWhere( 'nombre','like','%'.$search.'%');
            $query->orWhere( 'correo','like','%'.$search.'%');
            $query->orWhere( 'motivo','like','%'.$search.'%');
            $query->orWhere( 'servicios','like','%'.$search.'%');
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
