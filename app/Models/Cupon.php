<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $guarded = [];
    protected $table = 'cupones';
    protected $primaryKey = 'cupon_id';
protected $connection = 'pickapp_api';

    public static function search($pager,$search,$column,$order){

        $columns = [
            'column-1' =>'cupon_id',
            'column-2' =>'cupon_numero_usos',
            'column-3' =>'promocion_id',
            'column-4' =>'cupon_texto',
            'column-5' =>'created_at',
        ];



        $model = Cupon::where(function ($query) use ($search){
            $query->where('cupon_id','like','%'.$search.'%');
            $query->orWhere('cupon_texto','like','%'.$search.'%');
        });


        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }

        $model = $model->orderBy('cupon_id','desc')->paginate($pager);
        return $model;
    }



    public static function serviciosLista($id=null,$formato = null){
      $serviciosLista = array(
        1=>'Scharff express',
        2=>'Scharff stop',
        3=>'Envíos regulares'
      );


      if($formato=='plano'){

        $serviciosLista = array(
          1=>'scharff-express',
          2=>'scharff-stop',
          3=>'envios-regulares'
        );
      }


      if($id!=null&&isset($serviciosLista[$id])){
        return $serviciosLista[$id];
      }else{
        return $serviciosLista;
      }
    }






}
