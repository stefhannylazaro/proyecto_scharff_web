<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GobuyAlerta extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order){
        $columns = [
            'column-1'=>'id',
            'column-2'=>'alerta_descripcion',
            'column-3'=>'alerta_fecha',
            'column-4'=>'created_at'
        ];
        $model = GobuyAlerta::where(function ($query) use ($search){
            $query->where( 'alerta_descripcion','like','%'.$search.'%');
            $query->orWhere( 'id','like','%'.$search.'%');
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
        $model = GobuyAlerta::where(function ($query) use ($nombre){
            $query->where( 'nombre','like','%'.$nombre.'%');
        });

        return $model->limit(1)->get();
    }

}
