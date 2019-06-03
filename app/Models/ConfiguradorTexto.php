<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguradorTexto extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'vista',
            'column-2'=>'clave',
            'column-3'=>'titulo',
            'column-4'=>'descripcion',
        ];
        $model = ConfiguradorTexto::where(function ($query) use ($search){
            $query->where( 'titulo','like','%'.$search.'%');
            $query->orWhere( 'descripcion','like','%'.$search.'%');

        });


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('titulo','desc')->paginate($pager);
        return $model;
    }
}
