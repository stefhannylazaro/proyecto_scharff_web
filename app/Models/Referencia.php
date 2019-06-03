<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    protected $guarded = [];
    protected $table = 'referencia';
    protected $connection = 'pickapp_api';


    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'id',
            'column-2'=>'nombre',
        ];
        $model = Referencia::where(function ($query) use ($search){
            $query->where( 'id','like','%'.$search.'%');
            $query->orWhere( 'nombre','like','%'.$search.'%');
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
