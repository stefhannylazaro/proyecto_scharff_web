<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name', 'email', 'rol','password','usuario_nombre','usuario_apellidos','usuario_movil','usuario_tipo','usuario_dni','usuario_fbid'
        'name', 'email', 'rol','password','usuario_nombre','usuario_apellidos','usuario_movil','usuario_tipo','usuario_dni','usuario_fbid'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'user_id');
    }


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
        'usuario.usuario_id as id',
        'usuario.usuario_nombre',
        'usuario.usuario_email as usuario_email',
        'usuario.usuario_email as email',
        'usuario.usuario_apellidos',
        'usuario.usuario_movil',
        'usuario.usuario_tipo',
        'usuario.usuario_dni',
        'usuario.usuario_fecharegistro as created_at',
        'referencia.nombre as nombre_referencia'
        )
        ->leftjoin('referencia_usuario','usuario.usuario_webid','=','referencia_usuario.usuario_id')
        ->leftjoin('referencia','referencia_usuario.referencia_id','=','referencia.id')
        // ->leftjoin(DB::connection('pickapp_api')->table('referencia_usuario')->raw('referencia_usuario','usuario.id','=','referencia_usuario.usuario_id'))
        // ->leftjoin(DB::connection('pickapp_api')->table('referencia')->raw('referencia','referencia_usuario.referencia_id','=','referencia.id'))
        // ->leftjoin('referencia_usuario','usuario.id','=','referencia_usuario.usuario_id')
        // ->leftjoin('referencia','referencia_usuario.referencia_id','=','referencia.id')
        ->where(function ($query) use ($search){
            $query->where( 'usuario.usuario_email','like','%'.$search.'%');
            $query->orWhere( 'usuario.usuario_nombre','like','%'.$search.'%');
            $query->orWhere( 'usuario.usuario_apellidos','like','%'.$search.'%');
            $query->orWhere( 'usuario.usuario_movil','like','%'.$search.'%');
            $query->orWhere( 'usuario.usuario_dni','like','%'.$search.'%');
        })
        ->whereNotNull('usuario.usuario_webid');
        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('usuario.usuario_id','desc')->paginate($pager);
        return $model;

    }else if($quienes=='api'){
      $model = Usuario::select(
        'usuario.usuario_id as id',
        'usuario.usuario_email',
        'usuario.usuario_nombre',
        'usuario.usuario_apellidos',
        'usuario.usuario_movil',
        'usuario.usuario_tipo',
        'usuario.usuario_dni',
        //'usuario.created_at',
        'usuario.usuario_email as nombre_referencia'
        )
        // ->leftjoin(DB::connection('pickapp_api')->table('referencia_usuario')->raw('referencia_usuario','usuario.id','=','referencia_usuario.usuario_id'))
        // ->leftjoin(DB::connection('pickapp_api')->table('referencia')->raw('referencia','referencia_usuario.referencia_id','=','referencia.id'))
        // ->leftjoin('referencia_usuario','usuario.id','=','referencia_usuario.usuario_id')
        // ->leftjoin('referencia','referencia_usuario.referencia_id','=','referencia.id')
        ->where(function ($query) use ($search){
            $query->where( 'usuario.usuario_email','like','%'.$search.'%');
            $query->orWhere( 'usuario.usuario_nombre','like','%'.$search.'%');
            $query->orWhere( 'usuario.usuario_apellidos','like','%'.$search.'%');
            $query->orWhere( 'usuario.usuario_movil','like','%'.$search.'%');
            $query->orWhere( 'usuario.usuario_dni','like','%'.$search.'%');

        });
        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('usuario.usuario_id','desc')->paginate($pager);
        return $model;

    }else{
      $model = User::select('id','email','usuario_nombre','usuario_apellidos','usuario_movil','usuario_tipo','usuario_dni')
      ->where(function ($query) use ($search){
          $query->where( 'email','like','%'.$search.'%');
          $query->orWhere( 'usuario_nombre','like','%'.$search.'%');
          $query->orWhere( 'usuario_apellidos','like','%'.$search.'%');
          $query->orWhere( 'usuario_movil','like','%'.$search.'%');
          $query->orWhere( 'usuario_dni','like','%'.$search.'%');

      })->where('rol','superadmin');
    }
    if(!empty($fecha_inicio)&&!empty($fecha_fin)){
      $model->whereBetween('users.created_at', array($fecha_inicio,$fecha_fin));
    }




    if(@$column){
        if(@$columns[$column]){
            $model = $model->orderBy($columns[$column],$order);
        }else{
            abort(404);
        }
    }
    $model = $model->orderBy('users.id','desc')->paginate($pager);
    return $model;
}



    public static function findConReferencia($id){

      // $model = EnvioRegular::join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
      // ->where(function ($query) use ($search){
      //     $query->where( 'origen_calle','like','%'.$search.'%');
      //     $query->orWhere( 'destino_remitente','like','%'.$search.'%');
      //     $query->orWhere( 'created_at','like','%'.$search.'%');
      // });
      $model = User::select(
        'users.id',
        'users.email',
        'users.usuario_nombre',
        'users.usuario_apellidos',
        'users.usuario_movil',
        'users.usuario_tipo',
        'users.usuario_dni',
        'users.created_at',
        'referencia.nombre as nombre_referencia')
        ->leftjoin('referencia_usuario','users.id','=','referencia_usuario.usuario_id')
        ->leftjoin('referencia','referencia_usuario.referencia_id','=','referencia.id')
        ->where('users.id','like',$id);

      $model = $model->first();
      return $model;
    }

    // $model = \DB::table('reserva_lockers')
    //              //->join('users', 'users.id', '=', 'reserva_lockers.user_id')
    //              ->select('reserva_lockers.*');
    //
    //
    //   $model = $model->orderBy('id','desc');






}
