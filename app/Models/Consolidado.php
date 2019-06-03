<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consolidado extends Model
{
    protected $connection = 'pickapp_api';
    protected $guarded = [];
    protected $table = 'consolidado';
    protected $primaryKey = 'consolidado_id';

    protected $fillable = [
        'consolidado_codigo',
        'estado'

    ];

    public static function search($pager,$search,$column,$order){

        $columns = [
          'column-1' =>'consolidado_id',
          'column-2' =>'consolidado_codigo',
          'column-3' =>'estado'
        ];
        $model = Consolidado::where(function ($query) use ($search){
          $query->where( 'consolidado_id','like','%'.$search.'%');
          $query->orWhere( 'consolidado_codigo','like','%'.$search.'%');
        })->where( 'estado',1);


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('consolidado_id','desc')->paginate($pager);
        return $model;
    }


}
