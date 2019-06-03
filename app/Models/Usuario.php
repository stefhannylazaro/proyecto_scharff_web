<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  protected $connection = 'pickapp_api';

  protected $table = 'usuario';

  protected $primaryKey = 'usuario_id';

  protected $guarded = [];


  public $timestamps = false;

  /*add*/
  public static function search($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null,$quienes=null){

      $columns = [
        'column-1'=>'users.id',
        'column-2'=>'users.email',
        'column-3'=>'users.usuario_nombre',
        'column-4'=>'users.usuario_apellidos',
        'column-5'=>'users.usuario_dni',
        'column-6'=>'users.usuario_movil',
        'column-7'=>'referencia.nombre',
        'column-8'=>'users.created_at',
      ];

      if(!empty($fecha_inicio)){
        $fecha_inicio = urldecode($fecha_inicio);
      };
      if(!empty($fecha_fin)){
        $fecha_fin = urldecode($fecha_fin);
      };



      if($quienes=='todos'){


        $model = Usuario::select(
          'usuario.usuario_id',
          'usuario.usuario_email',
          'usuario.usuario_nombre',
          'usuario.usuario_apellidos',
          'usuario.usuario_movil',
          'usuario.usuario_telefono',
          'usuario.usuario_tipo',
          'usuario.usuario_dni',
          'usuario.usuario_fecharegistro',
          'usuario.usuario_genero',
          'usuario.usuario_ruc',
          'usuario.usuario_razonsocial',
          'usuario.usuario_escorporativo',
          'referencia.nombre as nombre_referencia')

          //->leftJoin('tarjeta', 'tarjeta.usuario_id', '=', 'usuario.usuario_id')//add
          ->leftjoin('referencia_usuario','usuario.usuario_webid','=','referencia_usuario.usuario_id')
          ->leftjoin('referencia','referencia_usuario.referencia_id','=','referencia.id')
          ->whereNotNull('usuario.usuario_webid')
          ->where(function ($query) use ($search){
              $query->where( 'usuario.usuario_email','like','%'.$search.'%');
              $query->orWhere( 'usuario.usuario_nombre','like','%'.$search.'%');
              $query->orWhere( 'usuario.usuario_apellidos','like','%'.$search.'%');
              $query->orWhere( 'usuario.usuario_movil','like','%'.$search.'%');
              $query->orWhere( 'usuario.usuario_dni','like','%'.$search.'%');
          });
      }

      if(!empty($fecha_inicio)&&!empty($fecha_fin)){
        $model->whereBetween('usuario.usuario_fecharegistro', array($fecha_inicio,$fecha_fin));
      }

      if(@$column){
          if(@$columns[$column]){
              $model = $model->orderBy($columns[$column],$order);
          }else{
              abort(404);
          }
      }
      $model = $model->orderBy('usuario.usuario_id','desc')->paginate($pager);
      return $model;
  }
}
