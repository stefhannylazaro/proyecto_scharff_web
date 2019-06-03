<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $guarded = [];
    protected $table = 'promociones';
    protected $primaryKey = 'promocion_id';

    protected $connection = 'pickapp_api';
    protected $fillable = [
        'promocion_id',
        'promocion_nombre',
        'tipo_id',
        'promocion_atributos',
        'promocion_descuento_flat',
        'promocion_descuento_porcentaje',
        'promocion_fecha_inicio',
        'promocion_fecha_fin',
        'promocion_cupon_bool',
        'promocion_prioridad',
        'promocion_cualesservicios',
        'promocion_transacciones',
        'promocion_minimo'
    ];





    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1' =>'promocion_id',
            'column-2' =>'promocion_nombre',
            'column-3' =>'tipo_id',
            //'column-4' =>'promocion_atributos',
            'column-4' =>'promocion_descuento_flat',
            'column-5' =>'promocion_fecha_inicio',
            'column-6' =>'promocion_fecha_fin',
            'column-7' =>'promocion_cupon_bool',
            'column-8' =>'promocion_prioridad',
            'column-9'=>'promocion_cualesservicios',
            'column-10'=>'promocion_transacciones'
        ];











        $model = Promocion::where(function ($query) use ($search){
            $query->where('promocion_cualesservicios','like','%'.$search.'%');
            $query->orWhere('promocion_nombre','like','%'.$search.'%');
        });


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }

        $model = $model->orderBy('promocion_id','desc')->paginate($pager);
        return $model;
    }



    public static function serviciosLista($id=null){
      $serviciosLista = array(
        1=>'Scharff express',
        2=>'Scharff stop',
        3=>'Envíos regulares'
      );

      if($id!=null&&isset($serviciosLista[$id])){
        return $serviciosLista[$id];
      }else{
        return $serviciosLista;
      }
    }








}
