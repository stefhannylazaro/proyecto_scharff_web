<?php

namespace App\Library;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Claimbook;
use Log;
use App\Models\ReservaLocker;
use App\Models\EnvioRegular;
use App\Models\Pedido;
use App\Models\Postulante;
use Carbon\Carbon;



class Funciones
{
    public static function generar_numero_reclamo(){
        $cantidad = Claimbook::count();

        $cadena = config('app.cadena_reclamo');

        $numero = (int) ($cantidad / 10000) + 1;
        $numero = str_pad($numero, 3, "0", STR_PAD_LEFT);

        $subnumero = ($cantidad % 10000) + 1;

        $subnumero = str_pad($subnumero, 4, "0", STR_PAD_LEFT);

        return $cadena . $numero . '-' . $subnumero;
    }
    public static function quitar_tildes($cadena) {
      $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
      $permitidas= array ("a","e","i","o","u","A","E","I","O","U","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
      $texto = str_replace($no_permitidas, $permitidas ,$cadena);
      return $texto;
    }
    public static function read_number($num){

      $list1 =array('cero',
     'Uno',
     'Dos',
     'Tres',
     'Cuatro',
     'Cinco',
     'Seis',
     'Siete',
     'Ocho',
     'Nueve',
     'Diez',
     'Once',
     'Doce',
     'Trece',
     'Catorce',
     'Quince',
     'Dieciséis',
     'Diecisiete',
     'Dieciocho',
     'Diecinueve',
     'Veinte',
     'Veintiuno',
     'Veintidos',
     'Veintitres',
     'Veinticuatro',
     'Veinticinco',
     'Veintiséis',
     'Veintisiete',
     'Veintiocho',
     'Veintinueve',
     'treinta',
     'treinta y Uno',
     'treinta y Dos',
     'treinta y Tres',
     'treinta y Cuatro',
     'treinta y Cinco',
     'treinta y Seis',
     'treinta y Siete',
     'treinta y Ocho',
     'treinta y Nueve',
     'Cuarenta',
     'Cuarenta y Uno',
     'Cuarenta y Dos',
     'Cuarenta y Tres',
     'Cuarenta y Cuatro',
     'Cuarenta y Cinco',
     'Cuarenta y Seis',
     'Cuarenta y Siete',
     'Cuarenta y Ocho',
     'Cuarenta y Nueve',
     'Cincuenta',
     'Cincuenta y Uno',
     'Cincuenta y Dos',
     'Cincuenta y Tres',
     'Cincuenta y Cuatro',
     'Cincuenta y Cinco',
     'Cincuenta y Seis',
     'Cincuenta y Siete',
     'Cincuenta y Ocho',
     'Cincuenta y Nueve',
     'Sesenta',
     'Sesenta y Uno',
     'Sesenta y Dos',
     'Sesenta y Tres',
     'Sesenta y Cuatro',
     'Sesenta y Cinco',
     'Sesenta y Seis',
     'Sesenta y Siete',
     'Sesenta y Ocho',
     'Sesenta y Nueve',
     'setenta',
     'setenta y Uno',
     'setenta y Dos',
     'setenta y Tres',
     'setenta y Cuatro',
     'setenta y Cinco',
     'setenta y Seis',
     'setenta y Siete',
     'setenta y Ocho',
     'setenta y Nueve',
     'Ochenta',
     'Ochenta y Uno',
     'Ochenta y Dos',
     'Ochenta y Tres',
     'Ochenta y Cuatro',
     'Ochenta y Cinco',
     'Ochenta y Seis',
     'Ochenta y Siete',
     'Ochenta y Ocho',
     'Ochenta y Nueve',
     'Noventa',
     'Noventa y Uno',
     'Noventa y Dos',
     'Noventa y Tres',
     'Noventa y Cuatro',
     'Noventa y Cinco',
     'Noventa y Seis',
     'Noventa y Siete',
     'Noventa y Ocho',
     'Noventa y Nueve',
     'cien');

      for ($i=0; $i < count($list1); $i++) {
        if($i==$num){
          return $list1[$i];
        }
      }
    }

    public static function enviar_correo_contacto($contacto,$motivoDetails){
        $email = $contacto->correo;
        $correoStaff = $motivoDetails['correo'];
        $contacto->mensaje_staff = $motivoDetails['mensaje_personalizado_staff'];
        $contacto->mensaje_cliente = $motivoDetails['mensaje_personalizado_cliente'];

        try {

            Log::info($correoStaff);


            Mail::send('email.contact', ['obj' => $contacto], function ($m) use ($email) {
                $m->to($email)->subject('Solicitud de Contacto!');
            });
            if(!empty($correoStaff)){
                Mail::send('email.correoStaff', ['obj' => $contacto,], function ($m) use ($correoStaff) {
                    $m->to($correoStaff)->subject('Solicitud de Contacto!');
                });
            }

        } catch (\Exception $e) {
            Log::info($e);
            $estado = 0;
        }
    }

    public static function enviar_correo_reclamo($claimbook,$enviar_correo_reclamo=NULL){
        $url = url()->to('/');
        $email = $claimbook->correo;

        try {
            Mail::send('email.claimbook' , [ 'obj' => $claimbook],
                function ($message) use ($email) {
                    $message->to($email)->subject('Solicitud de Reclamo');
                }
            );
        } catch (\Exception $e) {
            $estado = 0;
        }
        if (!empty($enviar_correo_reclamo)) {
            if (strpos($enviar_correo_reclamo, ',') !== false) {
              $correos_admins = explode(',', $enviar_correo_reclamo);
            }else{
              $correos_admins = $enviar_correo_reclamo;
            }



            Mail::send('email.claimbook_admin' , [ 'obj' => $claimbook],
                function ($message) use ($correos_admins) {
                    $message->to($correos_admins)->subject('Solicitud de Reclamo recibida');
                }
            );
        }
    }







    public static function searchGeneral($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
          'column-1' =>'id',
          'column-2' =>'created_at',
          'column-3' =>'usuario_id',
          'column-4' =>'usuario_nombre',
          'column-5' =>'usuario_apellidos',
          'column-6' =>'email',
          'column-7' =>'usuario_dni',
          'column-8' =>'tarifa',
          'column-9' =>'tarjeta_id',
          'column-10'=>'codigo_mediopago',

        ];


        if(!empty($fecha_inicio)){
          $fecha_inicio = ($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = ($fecha_fin);
        }

        $filtrar = false;


        //
        // $reservaLockerb = ReservaLocker::join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
        // ->select('reserva_lockers.id as id',
        //          'reserva_lockers.created_at as created_at',
        //          'usuario.usuario_id as usuario_id',
        //          'usuario.usuario_nombre as usuario_nombre',
        //          'usuario.usuario_apellidos as usuario_apellidos'
        //        );
        //
        //        echo "<!--<style>13</style>-->";
        //
        //
        // $reservaLocker = ReservaLocker::join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
        // ->select('reserva_lockers.id as id',
        //          'reserva_lockers.created_at as created_at',
        //          'usuario.usuario_id as usuario_id',
        //          'usuario.usuario_nombre as usuario_nombre',
        //          'usuario.usuario_apellidos as usuario_apellidos',
        //          'usuario.usuario_email as email',
        //          'usuario.usuario_dni as usuario_dni',
        //          'reserva_lockers.total_pagado as tarifa',
        //          'reserva_lockers.tarjeta_id as tarjeta_id',
        //          'reserva_lockers.codigo_culqi_pago as codigo_mediopago',
        //          'reserva_lockers.locker_id as locker_id'
        //        )->paginate($pager);
        //
        //        echo "<!--<style>14</style>-->";
        // $envioRegular = EnvioRegular::join('usuario', 'usuario.usuario_id', '=', 'envio_regular.usuario_id')
        // ->select('envio_regular.id as id',
        //          'envio_regular.created_at as created_at',
        //          'usuario.usuario_id as usuario_id',
        //          'usuario.usuario_nombre as usuario_nombre',
        //          'usuario.usuario_apellidos as usuario_apellidos',
        //          'usuario.usuario_email as email',
        //          'usuario.usuario_dni as usuario_dni',
        //          'envio_regular.costo_total as tarifa',
        //          'envio_regular.tarjeta_id as tarjeta_id',
        //          'envio_regular.codigo_culqi_pago as codigo_mediopago',
        //          'envio_regular.origen_ubigeo as origen_ubigeo'
        //        )->paginate($pager);
        //        echo "<!--<style>15</style>-->";
        //
        //
        // $pedidoExpress = Pedido::select(
        //          'pedido.pedido_codigo as id',
        //          'pedido.pedido_fechacreacion as created_at',
        //          // 'usuario.usuario_id as usuario_id',
        //          'pedido.pedido_nombrereceptor as usuario_nombre',
        //          'pedido.pedido_nombrereceptor as usuario_apellidos',
        //          // 'usuario.usuario_email as email',
        //          // 'usuario.usuario_dni as usuario_dni',
        //          'pedido.pedido_cuantopaga as tarifa'
        //          //'pedido.tarjeta_id as tarjeta_id',
        //          //'pedido.codigo_culqi_pago as codigo_mediopago',
        //          //'pedido.origen_ubigeo as origen_ubigeo'
        //        )->paginate($pager);
        //
        //   $result = $reservaLocker->merge($envioRegular)->merge($pedidoExpress)->sortByDesc('created_at');



      //
      // try {
      // $unatabla = DB::connection('pickapp_api')
      //   ->table('reserva_lockers')
      //   ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
      //   ->select([
      //     'reserva_lockers.id as id',
      //     'reserva_lockers.created_at as created_at',
      //     'usuario.usuario_id as usuario_id',
      //     'usuario.usuario_nombre as usuario_nombre',
      //     'usuario.usuario_apellidos as usuario_apellidos',
      //     'usuario.usuario_email as email',
      //     'usuario.usuario_dni as usuario_dni',
      //     'reserva_lockers.total_pagado as tarifa',
      //     'reserva_lockers.tarjeta_id as tarjeta_id',
      //     'reserva_lockers.codigo_culqi_pago as codigo_mediopago'
      //     //'reserva_lockers.locker_id as locker_id'
      //   ])
      //   ->addSelect(DB::raw("'reserva' as tipo"))
      //   ->where(function ($query) use ($search,$fecha_inicio, $fecha_fin){
      //
      //       $query->where( 'usuario.usuario_nombre','like','%'.$search.'%');
      //       $query->orWhere( 'usuario.usuario_apellidos','like','%'.$search.'%');
      //       $query->orWhere( 'usuario.usuario_email','like','%'.$search.'%');
      //       $query->orWhere( 'usuario.usuario_dni','like','%'.$search.'%');
      //
      //   })->where(function($query) use ($fecha_inicio, $fecha_fin) {
      //       if(!empty($fecha_inicio)&&!empty($fecha_fin)){
      //         return $query->whereBetween('reserva_lockers.created_at', array($fecha_inicio, $fecha_fin));
      //       }
      //   })
      //
      //   ->get()
      //   ->sortByDesc('created_at')
      //   ->take(10);
      //
      //   print_r($unatabla);







        $multipleUnion = DB::connection('pickapp_api')
          ->table('reserva_lockers')
          ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
          ->select([
            'reserva_lockers.id as id',
            'reserva_lockers.created_at as created_at',
            'usuario.usuario_id as usuario_id',
            'usuario.usuario_nombre as usuario_nombre',
            'usuario.usuario_apellidos as usuario_apellidos',
            'usuario.usuario_email as email',
            'usuario.usuario_dni as usuario_dni',
            'reserva_lockers.total_pagado as tarifa',
            'reserva_lockers.tarjeta_id as tarjeta_id',
            'reserva_lockers.codigo_culqi_pago as codigo_mediopago'
            //'reserva_lockers.locker_id as locker_id'
          ])
          ->addSelect(DB::connection('pickapp_api')->raw("'reserva' as tipo"))
          ->where(function ($query) use ($search,$fecha_inicio, $fecha_fin){
              $query->where( 'usuario.usuario_nombre','like','%'.$search.'%');
              $query->orWhere( 'usuario.usuario_apellidos','like','%'.$search.'%');
              $query->orWhere( 'usuario.usuario_email','like','%'.$search.'%');
              $query->orWhere( 'usuario.usuario_dni','like','%'.$search.'%');

          })
          ->where(function($query) use ($fecha_inicio, $fecha_fin) {
              if(!empty($fecha_inicio)&&!empty($fecha_fin)){
                return $query->whereBetween('reserva_lockers.created_at', array($fecha_inicio, $fecha_fin));
              }
          })
          ->union(
            DB::connection('pickapp_api')
            ->table('envio_regular')
            ->join('usuario', 'usuario.usuario_id', '=', 'envio_regular.usuario_id')
            ->select([
              'envio_regular.id as id',
              'envio_regular.created_at as created_at',
              'usuario.usuario_id as usuario_id',
              'usuario.usuario_nombre as usuario_nombre',
              'usuario.usuario_apellidos as usuario_apellidos',
              'usuario.usuario_email as email',
              'usuario.usuario_dni as usuario_dni',
              'envio_regular.costo_total as tarifa',
              'envio_regular.tarjeta_id as tarjeta_id',
              'envio_regular.codigo_culqi_pago as codigo_mediopago'
              //'envio_regular.origen_ubigeo as origen_ubigeo'
            ])
            ->addSelect(DB::connection('pickapp_api')->raw("'regular' as tipo"))
            ->where(function ($query) use ($search,$fecha_inicio, $fecha_fin){
                $query->where( 'usuario.usuario_nombre','like','%'.$search.'%');
                $query->orWhere( 'usuario.usuario_apellidos','like','%'.$search.'%');
                $query->orWhere( 'usuario.usuario_email','like','%'.$search.'%');
                $query->orWhere( 'usuario.usuario_dni','like','%'.$search.'%');

            })
            ->where(function($query) use ($fecha_inicio, $fecha_fin) {
                if(!empty($fecha_inicio)&&!empty($fecha_fin)){
                  return $query->whereBetween('envio_regular.created_at', array($fecha_inicio, $fecha_fin));
                }
            })
          )->union(
            DB::connection('pickapp_api')
            ->table('pedido')
            ->join('usuario', 'usuario.usuario_id', '=', 'pedido.usuario_id')
            ->select([
              'pedido.pedido_id as id',
              'pedido.pedido_fechacreacion as created_at',
              'pedido.usuario_id as usuario_id',
              // 'pedido.pedido_nombrereceptor as usuario_nombre',
              // 'pedido.pedido_nombrereceptor as usuario_apellidos',
              'usuario.usuario_nombre as usuario_nombre',
              'usuario.usuario_apellidos as usuario_apellidos',
              'usuario.usuario_email as email',
              'usuario.usuario_dni as usuario_dni',
              'pedido.pedido_cuantopaga as tarifa'
              //'pedido.tarjeta_id as tarjeta_id',
              //'pedido.codigo_culqi_pago as codigo_mediopago',
              //'pedido.origen_ubigeo as origen_ubigeo'
              //'envio_regular.origen_ubigeo as origen_ubigeo'
            ])

            //->addSelect(DB::raw("'' as usuario_id"))
            // ->addSelect(DB::raw("'' as email"))
            // ->addSelect(DB::raw("'' as usuario_dni"))
            ->addSelect(DB::raw("'' as tarjeta_id"))
            ->addSelect(DB::raw("'' as codigo_mediopago"))
            ->addSelect(DB::raw("'pedido' as tipo"))
            ->where(function ($query) use ($search,$fecha_inicio, $fecha_fin){
                $query->where( 'pedido.pedido_nombrereceptor','like','%'.$search.'%');
                $query->orWhere( 'pedido.pedido_nombrereceptor','like','%'.$search.'%');
            })
            ->where(function($query) use ($fecha_inicio, $fecha_fin) {
                if(!empty($fecha_inicio)&&!empty($fecha_fin)){
                  $query->whereBetween('pedido.pedido_fechacreacion', array($fecha_inicio, $fecha_fin));
                }
            })
          )
          ->get()
          ->sortByDesc('created_at');





        $totalCount = $multipleUnion->count();
        //$multipleUnion = collect($multipleUnion);
        //$multipleUnion =  $multipleUnion;

        // $results = $basicQuery
        //     ->take($perPage)
        //     ->skip($skip)
        //     ->get();
        //
        // $paginator = new \Illuminate\Pagination\LengthAwarePaginator($results, $totalCount, $take, $page);
        // return $paginator;


        if(@$column){
            if(@$columns[$column]){
                if($order=='desc'){
                  $multipleUnion = $multipleUnion->sortByDesc($columns[$column]);
                }else if($order=='asc'){
                  $multipleUnion = $multipleUnion->sortBy($columns[$column]);
                }

            }else{
                abort(404);
            }
        }
        $multipleUnion = $multipleUnion
        ->take($pager)
        ->slice(0);
        //print_r($multipleUnion);


      // }
      // catch (\Exception $e) {
      //     return $e->getMessage();
      // }
      //echo $totalCount;
      //print_r($multipleUnion);
      $multipleUnion->cuantosson = $totalCount;
      return $multipleUnion;


    }

    /*Descargar data*/
    public static function searchData($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
            'column-1' =>'id',
            'column-2' =>'created_at',
            'column-3' =>'usuario_id',
            'column-4' =>'usuario_nombre',
            'column-5' =>'usuario_apellidos',
            'column-6' =>'email',
            'column-7' =>'usuario_dni',
            'column-8' =>'tarifa',
            'column-9' =>'tarjeta_id',
            'column-10'=>'codigo_mediopago',

        ];


        if(!empty($fecha_inicio)){
            $fecha_inicio = ($fecha_inicio);
        }
        if(!empty($fecha_fin)){
            $fecha_fin = ($fecha_fin);
        }

        $filtrar = false;


        $multipleUnion = DB::connection('pickapp_api')
            ->table('reserva_lockers')
            ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
            ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'reserva_lockers.tarjeta_id')//add
            ->leftJoin('descuentos', 'descuentos.descuento_transaccion_id', '=', 'reserva_lockers.id')//add..
            ->leftJoin('promociones', 'promociones.promocion_id', '=', 'descuentos.promocion_id')//add..
            // ->leftJoin('referencia_usuario', 'usuario.usuario_webid', '=', 'referencia_usuario.usuario_id')
            // ->leftJoin('referencia', 'referencia_usuario.referencia_id', '=', 'referencia.id')

            ->select([
                'reserva_lockers.id as id',
                'reserva_lockers.created_at as created_at',
                'usuario.usuario_id as usuario_id',
                'usuario.usuario_nombre as usuario_nombre',
                'usuario.usuario_apellidos as usuario_apellidos',
                'usuario.usuario_email as email',
                'usuario.usuario_dni as usuario_dni',
                'reserva_lockers.reserva_ruc as usuario_ruc',
                'reserva_lockers.reserva_razonsocial as usuario_razonsocial',
                'reserva_lockers.total_pagado as tarifa',
                'reserva_lockers.tarjeta_id as tarjeta_id',
                'reserva_lockers.codigo_culqi_pago as codigo_mediopago',
                'reserva_lockers.estado_medio_pago as estado_mediopago',
                'reserva_lockers.emitir_factura as emitir_factura',//add
                'tarjeta.tarjeta_marca as tarjeta_marca',//add
                'promociones.promocion_nombre as promocion_nombre',
                'descuentos.descuento_monto as descuento_monto',
                // 'referencia.nombre as tipo'
            ])
            ->addSelect(DB::connection('pickapp_api')->raw("'reserva' as tipo"))
            ->where(function ($query) use ($search,$fecha_inicio, $fecha_fin){
                $query->where( 'usuario.usuario_nombre','like','%'.$search.'%');
                $query->orWhere( 'usuario.usuario_apellidos','like','%'.$search.'%');
                $query->orWhere( 'usuario.usuario_email','like','%'.$search.'%');
                $query->orWhere( 'usuario.usuario_dni','like','%'.$search.'%');
                $query->orWhere( 'usuario.usuario_ruc','like','%'.$search.'%');

            })
            ->where(function($query) use ($fecha_inicio, $fecha_fin) {
                if(!empty($fecha_inicio)&&!empty($fecha_fin)){
                    return $query->whereBetween('reserva_lockers.created_at', array($fecha_inicio, $fecha_fin));
                }
            })
            ->union(
                DB::connection('pickapp_api')
                    ->table('envio_regular')
                    ->join('usuario', 'usuario.usuario_id', '=', 'envio_regular.usuario_id')
                    ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'envio_regular.tarjeta_id')//add
                    ->leftJoin('descuentos', 'descuentos.descuento_transaccion_id', '=', 'envio_regular.id')//add..
                    ->leftJoin('promociones', 'promociones.promocion_id', '=', 'descuentos.promocion_id')//add..
                    // ->leftJoin('referencia_usuario', 'usuario.usuario_webid', '=', 'referencia_usuario.usuario_id')
                    // ->leftJoin('referencia', 'referencia_usuario.referencia_id', '=', 'referencia.id')
                    ->select([
                        'envio_regular.id as id',
                        'envio_regular.created_at as created_at',
                        'usuario.usuario_id as usuario_id',
                        'usuario.usuario_nombre as usuario_nombre',
                        'usuario.usuario_apellidos as usuario_apellidos',
                        'usuario.usuario_email as email',
                        'usuario.usuario_dni as usuario_dni',
                        'envio_regular.regular_ruc as usuario_ruc',
                        'envio_regular.regular_razonsocial as usuario_razonsocial',
                        'envio_regular.costo_total as tarifa',
                        'envio_regular.tarjeta_id as tarjeta_id',
                        'envio_regular.codigo_culqi_pago as codigo_mediopago',
                        'envio_regular.estado_medio_pago as estado_mediopago',
                        'envio_regular.emitir_factura as emitir_factura',//add
                        'tarjeta.tarjeta_marca as tarjeta_marca',//add
                        'promociones.promocion_nombre as promocion_nombre',
                        'descuentos.descuento_monto as descuento_monto',
                        //'referencia.nombre as tipo'
                    ])
                    ->addSelect(DB::connection('pickapp_api')->raw("'regular' as tipo"))
                    ->where(function ($query) use ($search,$fecha_inicio, $fecha_fin){
                        $query->where( 'usuario.usuario_nombre','like','%'.$search.'%');
                        $query->orWhere( 'usuario.usuario_apellidos','like','%'.$search.'%');
                        $query->orWhere( 'usuario.usuario_email','like','%'.$search.'%');
                        $query->orWhere( 'usuario.usuario_dni','like','%'.$search.'%');
                        $query->orWhere( 'usuario.usuario_ruc','like','%'.$search.'%');

                    })
                    ->where(function($query) use ($fecha_inicio, $fecha_fin) {
                        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
                            return $query->whereBetween('envio_regular.created_at', array($fecha_inicio, $fecha_fin));
                        }
                    })
            )->union(
                DB::connection('pickapp_api')
                    ->table('pedido')
                    ->join('usuario', 'usuario.usuario_id', '=', 'pedido.usuario_id')
                    ->leftJoin('pedidoinfo', 'pedidoinfo.pedido_id', '=', 'pedido.pedido_id')//add
                    ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'pedido.tarjeta_id')//add
                    ->leftJoin('descuentos', 'descuentos.descuento_transaccion_id', '=', 'pedido.pedido_id')//add.. **
                    ->leftJoin('promociones', 'promociones.promocion_id', '=', 'descuentos.promocion_id')//add..**
                    // ->leftJoin('referencia_usuario', 'usuario.usuario_webid', '=', 'referencia_usuario.usuario_id')
                    // ->leftJoin('referencia', 'referencia_usuario.referencia_id', '=', 'referencia.id')
                    ->select([
                        'pedido.pedido_id as id',
                        'pedido.pedido_fechacreacion as created_at',
                        'usuario.usuario_id as usuario_id',

                        'usuario.usuario_nombre as usuario_nombre',
                        'usuario.usuario_apellidos as usuario_apellidos',
                        'usuario.usuario_email as email',
                        'usuario.usuario_dni as usuario_dni',
                        'pedido.pedido_cuantopaga as tarifa',
                        //'pedido.tarjeta_id as tarjeta_id',
                        //'pedido.codigo_culqi_pago as codigo_mediopago',
                        //'pedido.origen_ubigeo as origen_ubigeo'
                        //'envio_regular.origen_ubigeo as origen_ubigeo'
                        'tarjeta.tarjeta_marca as tarjeta_marca',
                        'promociones.promocion_nombre as promocion_nombre',
                        'descuentos.descuento_monto as descuento_monto',
                        'pedidoinfo.pedido_ruc as usuario_ruc',
                        'pedidoinfo.pedido_razonsocial as usuario_razonsocial',
                        'pedidoinfo.estado_medio_pago as estado_mediopago',
                        'pedidoinfo.pedido_emitirfactura as emitir_factura',
                        //'referencia.nombre as tipo'
                    ])
                    ->addSelect(DB::raw("'' as tarjeta_id"))
                    ->addSelect(DB::raw("'' as codigo_mediopago"))
                    //->addSelect(DB::raw("'' as tarjeta_marca"))
                    //->addSelect(DB::raw("'' as promocion_nombre"))
                    //->addSelect(DB::raw("'' as descuento_monto"))
                    ->addSelect(DB::raw("'pedido' as tipo"))
                    ->where(function ($query) use ($search,$fecha_inicio, $fecha_fin){
                        $query->where( 'pedido.pedido_nombrereceptor','like','%'.$search.'%');
                        $query->orWhere( 'pedido.pedido_nombrereceptor','like','%'.$search.'%');
                    })
                    ->where(function($query) use ($fecha_inicio, $fecha_fin) {
                        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
                            $query->whereBetween('pedido.pedido_fechacreacion', array($fecha_inicio, $fecha_fin));
                        }
                    })
            )
            ->get()
            ->sortByDesc('created_at');





        $totalCount = $multipleUnion->count();
        //$multipleUnion = collect($multipleUnion);
        //$multipleUnion =  $multipleUnion;

        // $results = $basicQuery
        //     ->take($perPage)
        //     ->skip($skip)
        //     ->get();
        //
        // $paginator = new \Illuminate\Pagination\LengthAwarePaginator($results, $totalCount, $take, $page);
        // return $paginator;


        if(@$column){
            if(@$columns[$column]){
                if($order=='desc'){
                    $multipleUnion = $multipleUnion->sortByDesc($columns[$column]);
                }else if($order=='asc'){
                    $multipleUnion = $multipleUnion->sortBy($columns[$column]);
                }

            }else{
                abort(404);
            }
        }
        $multipleUnion = $multipleUnion
            ->take($pager)
            ->slice(0);
        //print_r($multipleUnion);


        // }
        // catch (\Exception $e) {
        //     return $e->getMessage();
        // }
        //echo $totalCount;
        $multipleUnion->cuantosson = $totalCount;

        return $multipleUnion;


    }
    /*Fin descargar data*/


    public static function estadisticasDashboard(){


        $a = DB::connection('pickapp_api')
          ->table('reserva_lockers')
          ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'), DB::raw('sum(total_pagado) as sums'))
          ->groupBy('date')
          ->get()->toArray();

        $b = DB::connection('pickapp_api')
          ->table('envio_regular')
          ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'), DB::raw('sum(costo_total) as sums'))
          ->groupBy('date')
          ->get()->toArray();

        $c = DB::connection('pickapp_api')
          ->table('pedido')
          ->select(DB::raw('DATE(pedido_fechacreacion) as date'), DB::raw('count(*) as views'), DB::raw('sum(pedido_cuantopaga) as sums'))
          ->groupBy('date')
          ->get()->toArray();


        $now = \Carbon\Carbon::now();
        $dates = [$now->format('Y-m-d')];


        for($i = 1; $i < 30; $i++) {
          $dates[] = $now->subDays(1)->format('Y-m-d');
        }

        $suma = 0;
        $aa = [];
        foreach ($a as $a_i) {
          $aa[$a_i->date] = $a_i->views;
          $suma += $a_i->sums;
        }

        $bb = [];
        foreach ($b as $b_i) {
          $bb[$b_i->date] = $b_i->views;
          $suma += $b_i->sums;
        }


        $cc = [];
        foreach ($c as $c_i) {
          $cc[$c_i->date] = $c_i->views;
          $suma += $c_i->sums;
        }


        //print_r($aa);
        $dates_full = [];
        $dates_fullb = [];
        $dates_fullc = [];
        foreach ($dates as $key => $value) {
          //echo $value ."\n\r";
          $array = array(
              "date" => $value,
              "views" => isset($aa[$value])?$aa[$value]:0,
          );

          $arrayb = array(
              "date" => $value,
              "views" => isset($bb[$value])?$bb[$value]:0,
          );

          $arrayc = array(
              "date" => $value,
              "views" => isset($cc[$value])?$cc[$value]:0,
          );

          $books = (object) $array;
          $booksb = (object) $arrayb;
          $booksc = (object) $arrayc;
          //if(isset($elements[$value])){
          $dates_full[] = $books;
          $dates_fullb[] = $booksb;
          $dates_fullc[] = $booksc;
          //}
          //$dates_full[$value] = isset($elements[$value])?$elements[$value]:0;
        }








        return [$dates_full,$dates_fullb,$dates_fullc,$suma];
    }



    public static function usuarios_mes_Dashboard(){

      $u = DB::connection('pickapp_api')
        ->table('usuario')
        ->select(DB::raw('DATE(usuario_fecharegistro) as date'), DB::raw('count(*) as views'))
        ->groupBy('date')
        ->whereMonth(
            'usuario_fecharegistro', '=', Carbon::now()->subMonth()->month
        )
        ->get()->toArray();

        $uu_total_mes = 0;
        foreach ($u as $u_i) {
          $uu_total_mes += $u_i->views;
        }

      return $uu_total_mes;
    }


    public static function postulaciones_mes_Dashboard(){


      $u = DB::table('postulantes')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
        ->groupBy('date')
        ->whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )
        ->get()->toArray();

        $uu_total_mes = 0;
        foreach ($u as $u_i) {
          $uu_total_mes += $u_i->views;
        }

      return $uu_total_mes;
    }


    public static function contactos_mes_Dashboard(){


      $u = DB::table('contacts')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
        ->groupBy('date')
        ->whereMonth(
            'created_at', '>=', Carbon::now()->subMonth()->month
        )
        ->get()->toArray();


        $uu_total_mes = 0;
        foreach ($u as $u_i) {
          $uu_total_mes += $u_i->views;
        }

      return $uu_total_mes;
    }

    public static function postulantes_ultimos_Dashboard(){


      $model = Postulante::where(function ($query){
      });
      $model = $model->orderBy('id','desc')->paginate(10);
      return $model;
    }












}
