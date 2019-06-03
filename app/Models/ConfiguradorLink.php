<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguradorLink extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'vista',
            'column-2'=>'clave',
            'column-3'=>'titulo',
            'column-4'=>'link',
        ];
        $model = ConfiguradorLink::where(function ($query) use ($search){
            $query->where( 'vista','like','%'.$search.'%');
            $query->orWhere( 'clave','like','%'.$search.'%');
            $query->orWhere( 'titulo','like','%'.$search.'%');
            $query->orWhere( 'link','like','%'.$search.'%');

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
