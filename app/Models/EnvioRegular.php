<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvioRegular extends Model
{
    protected $connection = 'pickapp_api';
    protected $table = 'envio_regular';
    protected $guarded = [];

    public static function search($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
          'column-1' =>'id',
          'column-2' =>'origen_calle',
          'column-3' =>'origen_direccion_full',
          'column-4' =>'origen_interior',
          'column-5' =>'origen_referencia',
          'column-6' =>'origen_remitente',
          'column-7' =>'origen_celular',
          'column-8' =>'destino_calle',
          'column-9' =>'destino_direccion_full',
          'column-10' =>'destino_interior',
          'column-11' =>'destino_referencia',
          'column-12' =>'destino_remitente',
          'column-13' =>'destino_celular',
          'column-14' =>'ancho',
          'column-15' =>'peso',
          'column-16' =>'tiempo',
          'column-17' =>'costo_total',
          'column-18' =>'cupon_descuento',
          'column-19' =>'tarjeta_id',
          'column-20' =>'usuario_id',
          'column-21' =>'usuario_nombre',
          'column-22' =>'created_at'
        ];



        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }


        // $model = EnvioRegular::join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
        // ->where(function ($query) use ($search){
        //     $query->where( 'origen_calle','like','%'.$search.'%');
        //     $query->orWhere( 'destino_remitente','like','%'.$search.'%');
        //     $query->orWhere( 'created_at','like','%'.$search.'%');
        // });

        $model = EnvioRegular::where(function ($query) use ($search){
            $query->where( 'origen_calle','like','%'.$search.'%');
            $query->orWhere( 'destino_remitente','like','%'.$search.'%');
            $query->orWhere( 'origen_remitente','like','%'.$search.'%');
            $query->orWhere( 'destino_remitente','like','%'.$search.'%');
            $query->orWhere( 'destino_celular','like','%'.$search.'%');
            $query->orWhere( 'peso','like','%'.$search.'%');
        });


        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
          $model->whereBetween('created_at', array($fecha_inicio,$fecha_fin));
        }

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



public static function searchdownloaddata($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

    $columns = [
      'column-1' =>'envio_regular.id',
      'column-2' =>'origen_calle',
      'column-3' =>'origen_direccion_full',
      'column-4' =>'origen_interior',
      'column-5' =>'origen_referencia',
      'column-6' =>'origen_remitente',
      'column-7' =>'origen_celular',
      'column-8' =>'destino_calle',
      'column-9' =>'destino_direccion_full',
      'column-10' =>'destino_interior',
      'column-11' =>'destino_referencia',
      'column-12' =>'destino_remitente',
      'column-13' =>'destino_celular',
      'column-14' =>'ancho',
      'column-15' =>'peso',
      'column-16' =>'tiempo',
      'column-17' =>'costo_total',
      'column-18' =>'cupon_descuento',
      'column-19' =>'tarjeta_id',
      'column-20' =>'usuario_id',
      'column-21' =>'usuario_nombre',
      'column-22' =>'created_at'
    ];



    if(!empty($fecha_inicio)){
      $fecha_inicio = urldecode($fecha_inicio);
    }
    if(!empty($fecha_fin)){
      $fecha_fin = urldecode($fecha_fin);
    }


    // $model = EnvioRegular::join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
    // ->where(function ($query) use ($search){
    //     $query->where( 'origen_calle','like','%'.$search.'%');
    //     $query->orWhere( 'destino_remitente','like','%'.$search.'%');
    //     $query->orWhere( 'created_at','like','%'.$search.'%');
    // });

    $model = \DB::connection('pickapp_api')
      ->table('envio_regular')
      ->leftJoin('usuario', 'envio_regular.usuario_id', '=', 'usuario.usuario_id')
      ->leftJoin('referencia_usuario', 'usuario.usuario_webid', '=', 'referencia_usuario.usuario_id')
      ->leftJoin('referencia', 'referencia_usuario.referencia_id', '=', 'referencia.id')
      ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'envio_regular.tarjeta_id')
      ->leftJoin('descuentos', 'descuentos.descuento_transaccion_id', '=', 'envio_regular.id')
      ->leftJoin('promociones', 'descuentos.promocion_id', '=', 'promociones.promocion_id')
      ->where(function ($query) use ($search){
          $query->where( 'envio_regular.origen_calle','like','%'.$search.'%');
          $query->orWhere( 'envio_regular.destino_remitente','like','%'.$search.'%');
          $query->orWhere( 'envio_regular.origen_remitente','like','%'.$search.'%');
          $query->orWhere( 'envio_regular.destino_remitente','like','%'.$search.'%');
          $query->orWhere( 'envio_regular.destino_celular','like','%'.$search.'%');
          $query->orWhere( 'envio_regular.peso','like','%'.$search.'%');
          $query->orWhere( 'descuentos.descuento_tipo_servicio','like','envios-regulares');
      })
      ->select(
        'envio_regular.*',
        'usuario.*',
        'referencia.nombre as referencia_nombre',
        'descuentos.descuento_monto as descuento_monto',
        'tarjeta.tarjeta_marca as tarjeta_marca',
        'promociones.promocion_nombre as promocion_nombre'
      );




    if(!empty($fecha_inicio)&&!empty($fecha_fin)){
      $model->whereBetween('created_at', array($fecha_inicio,$fecha_fin));
    }

    if(@$column){
        if(@$columns[$column]){
            $model = $model->orderBy($columns[$column],$order);
        }else{
            abort(404);
        }
    }
    $model = $model->orderBy('envio_regular.id','desc')->paginate($pager);

return $model;
    //return $model;
}







    public function tiempoValor(){

      switch ($this->tiempo) {
        case 0:
          $cadena = '24h';
          break;
        case 1:
          $cadena = '72h';
          break;
        case 2:
          $cadena = '+72h';
          break;
        default:
          $cadena = '';
          break;
      }
      return $cadena;
    }

    public function sizeCodigo(){
        switch ($this->size) {
            case 'GRANDE':
                $cadena = 3;
                break;
            case 'MEDIANO':
                $cadena = 2;
                break;
            case 'PEQUEÑO':
                $cadena = 1;
                break;
            default:
                $cadena = 1;
                break;
        }

        return $cadena;
    }



    public static function searchConUsuarios($pager,$search,$column,$order){
      $columns = [
        'column-1' =>'id',
        'column-2' =>'origen_calle',
        'column-3' =>'origen_direccion_full',
        'column-4' =>'origen_interior',
        'column-5' =>'origen_referencia',
        'column-6' =>'origen_remitente',
        'column-7' =>'origen_celular',
        'column-8' =>'destino_calle',
        'column-9' =>'destino_direccion_full',
        'column-10' =>'destino_interior',
        'column-11' =>'destino_referencia',
        'column-12' =>'destino_remitente',
        'column-13' =>'destino_celular',
        'column-14' =>'ancho',
        'column-15' =>'altura',
        'column-16' =>'profundidad',
        'column-17' =>'peso',
        'column-18' =>'tiempo',
        'column-19' =>'costo_total',
        'column-20' =>'cupon_descuento',
        'column-21' =>'tarjeta_id',
        'column-22' =>'usuario_id',
        'column-23' =>'usuario_nombre',

      ];
      // $model = EnvioRegular::join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
      // ->where(function ($query) use ($search){
      //     $query->where( 'origen_calle','like','%'.$search.'%');
      //     $query->orWhere( 'destino_remitente','like','%'.$search.'%');
      //     $query->orWhere( 'created_at','like','%'.$search.'%');
      // });


      $model = EnvioRegular::select('envio_regular.*', 'usuario.usuario_nombre')
        ->join('usuario','envio_regular.usuario_id','=','usuario.usuario_id')
        ->where(function ($query) use ($search){
          $query->where( 'origen_calle','like','%'.$search.'%');
          $query->orWhere( 'destino_remitente','like','%'.$search.'%');
          $query->orWhere( 'created_at','like','%'.$search.'%');
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



    public static function findConUsuario($id){

      // $model = EnvioRegular::join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
      // ->where(function ($query) use ($search){
      //     $query->where( 'origen_calle','like','%'.$search.'%');
      //     $query->orWhere( 'destino_remitente','like','%'.$search.'%');
      //     $query->orWhere( 'created_at','like','%'.$search.'%');
      // });


      $model = EnvioRegular::select('envio_regular.*', 'usuario.usuario_nombre')
        ->join('usuario','envio_regular.usuario_id','=','usuario.usuario_id')
        ->where('envio_regular.id','like',$id);



      $model = $model->first();
      return $model;
    }







}
