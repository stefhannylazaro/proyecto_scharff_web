<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotivoContacto extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order){






        $columns = [
            'column-1'=>'nombre',
            'column-2'=>'correo',
            'column-3'=>'orden',
            'column-4'=>'mensaje_personalizado_staff',
            'column-5'=>'mensaje_personalizado_cliente',
            'column-6'=>'created_at'
        ];
        $model = MotivoContacto::where(function ($query) use ($search){
            $query->where( 'nombre','like','%'.$search.'%');
            $query->orWhere( 'correo','like','%'.$search.'%');
            $query->orWhere( 'mensaje_personalizado_staff','like','%'.$search.'%');
            $query->orWhere( 'mensaje_personalizado_cliente','like','%'.$search.'%');
        });


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

    public static function correoByMotivo($nombre){
        $model = MotivoContacto::where(function ($query) use ($nombre){
            $query->where( 'nombre','like','%'.$nombre.'%');
        });

        return $model->limit(1)->get();
    }

}
