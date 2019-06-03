<?php

namespace App\Models;

use App\Http\Requests\SucursalRequest;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $guarded = [];

    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1'=>'pais',
            'column-2'=>'ciudad',
            'column-3'=>'created_at'
        ];
        $model = Sucursal::where(function ($query) use ($search){
            $query->where( 'pais','like','%'.$search.'%');
            $query->orWhere( 'ciudad','like','%'.$search.'%');

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
