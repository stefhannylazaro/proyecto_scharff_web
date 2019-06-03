<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'titulo',
            'column-2'=>'orden',
            'column-3'=>'created_at'
        ];
        $model = Servicio::where(function ($query) use ($search){
            $query->where( 'titulo','like','%'.$search.'%');

        })->where('estado',1);


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
