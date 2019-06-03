<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $connection = 'pickapp_api';
    protected $guarded = [];

    public static function search($pager,$search,$column,$order){

        $columns = [
          'column-1' =>'id',
          'column-2' =>'nombre',
          'column-3' =>'direccion',
          'column-4' =>'size'
        ];

        $model = Locker::where(function ($query) use ($search){
            $query->where( 'direccion','like','%'.$search.'%');
            $query->orWhere( 'size','like','%'.$search.'%');
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




    public static function reservaConUsuario($id){



    }





}
