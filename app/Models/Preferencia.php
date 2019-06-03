<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preferencia extends Model
{
    protected $guarded = [];
    protected $table = 'preferencias';



    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'id',
            'column-2'=>'nombre',
            'column-3'=>'valor',
        ];

        $model = Preferencia::where(function ($query) use ($search){
            $query->where('id','like','%'.$search.'%');
            $query->orWhere('nombre','like','%'.$search.'%');
            $query->orWhere('valor','like','%'.$search.'%');
        });


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('nombre','desc')->paginate($pager);
        return $model;
    }

}
