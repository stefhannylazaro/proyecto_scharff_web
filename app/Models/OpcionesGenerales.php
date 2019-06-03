<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpcionesGenerales extends Model
{
  protected $guarded = [];
  protected $connection = 'pickapp_api';
  protected $table = 'opciones_generales';

  public static function getOptiones(){
    $model = OpcionesGenerales::where(function ($query) use ($search){
        $query->where( 'nombre','like','%'.$search.'%');
    });
    return $model;
  }

  public static function search($pager,$search,$column,$order){

      $columns = [
          'column-1'=>'nombre',
          'column-2'=>'valor',
      ];
      $model = OpcionesGenerales::where(function ($query) use ($search){
          $query->where( 'nombre','like','%'.$search.'%');
          $query->where( 'valor','like','%'.$search.'%');

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

  public static function searchCodigoPedidos($pager,$search,$column,$order,$option){
      $columns = [
          'column-1'=>'nombre',
          'column-2'=>'valor',
      ];
      $model = OpcionesGenerales::where(function ($query) use ($search,$option){
          $query->where( 'slug','like','%'.$option.'%');
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


  public static function getOptionValue($nombre){
    $model = OpcionesGenerales::where(function ($query) use ($nombre){
        $query->where( 'nombre','like','%'.$nombre.'%');
    });


    return $model;
  }

}
