<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];
    protected $fillable = [
        //'name', 'email', 'rol','password','usuario_nombre','usuario_apellidos','usuario_movil','usuario_tipo','usuario_dni','usuario_fbid'
        'titulo', 'imagen', 'subtitulo', 'slug', 'url','atributos'
    ];
    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'titulo',
            'column-2'=>'subtitulo',
            'column-3'=>'slug',
            'column-4'=>'created_at'
        ];
        $model = Banner::where(function ($query) use ($search){
            $query->where( 'titulo','like','%'.$search.'%');
            $query->orWhere( 'subtitulo','like','%'.$search.'%');
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
}
