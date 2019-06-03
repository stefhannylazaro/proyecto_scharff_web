<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaLocker extends Model
{
    protected $connection = 'pickapp_api';

    protected $guarded = [];

    public static function search($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null,$contexto=null){

        $columns = [
          'column-1' =>'id',
          'column-2' =>'estadoReserva',
          'column-3' =>'created_at',
          'column-4' =>'fecha_reserva',
          'column-5' =>'fecha_entrega',
          'column-6' =>'fecha_recojo',
          'column-7' =>'codigo_recojo',
          'column-8' =>'contacto',
          'column-9' =>'dni',
          'column-10'=>'correo',
          'column-11' =>'celular',
          'column-12' => 'total_pagado',
          'column-13' => 'size',
          'column-14' => 'articulo',
          'column-15' =>'tarjeta_id',

















        ];


        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }


        $filtrar = false;




        $model = ReservaLocker::leftJoin('lockers', 'lockers.id', '=', 'reserva_lockers.locker_id')
            ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
            //->join('descuentos', 'descuentos.descuento_transaccion_id', '=', 'reserva_lockers.locker_id')
            // ->join('promociones', 'promocion_id', '=', 'descuentos.promocion_id')
            ->select('reserva_lockers.*',
                'lockers.codigo_referencial',
                'lockers.nombre as locker_nombre',
                'usuario.usuario_nombre',
                'usuario.usuario_apellidos',
                'usuario.usuario_tipo',//add
                'usuario.usuario_ruc',//add
                'usuario.usuario_razonsocial',//add
                //\DB::raw('CONCAT(usuario.usuario_nombre, ", ", usuario.usuario_apellidos) AS emisor_nombre'),
                \DB::raw('usuario.usuario_movil AS emisor_celular'),
                \DB::raw('usuario.usuario_email AS emisor_email'),
                \DB::raw('usuario.usuario_dni AS emisor_dni')
            )
          ->whereNotNull('reserva_lockers.locker_id')
          ->where(function ($query) use ($search){
            $query->where( 'reserva_lockers.contacto','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.correo','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.celular','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.size','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.dni','like','%'.$search.'%');
        });


        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
          $model->whereBetween('reserva_lockers.created_at', array($fecha_inicio,$fecha_fin));
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



    /*search exel*/
    public static function searchDownloadData($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null,$contexto=null){

        $columns = [
          'column-1' =>'id',
          'column-2' =>'estadoReserva',
          'column-3' =>'created_at',
          'column-4' =>'fecha_reserva',
          'column-5' =>'fecha_entrega',
          'column-6' =>'fecha_recojo',
          'column-7' =>'codigo_recojo',
          'column-8' =>'contacto',
          'column-9' =>'dni',
          'column-10'=>'correo',
          'column-11' =>'celular',
          'column-12' => 'total_pagado',
          'column-13' => 'size',
          'column-14' => 'articulo',
          'column-15' =>'tarjeta_id',

        ];


        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }





        $filtrar = false;
        $model = ReservaLocker::leftJoin('lockers', 'lockers.id', '=', 'reserva_lockers.locker_id')
            ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
            ->leftJoin('referencia_usuario', 'usuario.usuario_webid', '=', 'referencia_usuario.usuario_id')
            ->leftJoin('referencia', 'referencia_usuario.referencia_id', '=', 'referencia.id')
            ->leftJoin('descuentos', 'descuentos.descuento_transaccion_id', '=', 'reserva_lockers.id')
            ->leftJoin('promociones', 'promociones.promocion_id', '=', 'descuentos.promocion_id')
            ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'reserva_lockers.tarjeta_id')
            ->select('reserva_lockers.*',
                'lockers.codigo_referencial',
                'lockers.nombre as locker_nombre',
                'usuario.usuario_nombre',
                'usuario.usuario_apellidos',
                'usuario.usuario_tipo',//add
                'usuario.usuario_ruc',//add
                'usuario.usuario_razonsocial',//add
                'usuario.usuario_email',//add
                'usuario.usuario_movil',//add
                'usuario.usuario_id',//add
                'promociones.promocion_nombre',//add
                'descuentos.descuento_monto',//add
                'tarjeta.tarjeta_marca',//add
                'referencia.nombre as referencia_nombre',
                //\DB::raw('CONCAT(usuario.usuario_nombre, ", ", usuario.usuario_apellidos) AS usuario_nombre_c'),
                \DB::raw('usuario.usuario_movil AS emisor_celular'),
                \DB::raw('usuario.usuario_email AS emisor_email'),
                \DB::raw('usuario.usuario_dni AS emisor_dni')
            )
          ->whereNotNull('reserva_lockers.locker_id')
          ->where(function ($query) use ($search){
            $query->where( 'reserva_lockers.contacto','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.correo','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.celular','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.size','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.dni','like','%'.$search.'%');
        });


        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
          $model->whereBetween('reserva_lockers.created_at', array($fecha_inicio,$fecha_fin));
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
    /*end search exel*/

    /*search exel data sistema*/

    public static function searchDownloadSistemas($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null,$contexto=null){

        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }

        $filtrar = false;

        $model = ReservaLocker::leftJoin('lockers', 'lockers.id', '=', 'reserva_lockers.locker_id')
            ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')

            ->select('reserva_lockers.*',
                'lockers.codigo_referencial',
                'lockers.direccion',
                'lockers.nombre AS lockers_nombre',//*
                'usuario.usuario_nombre',
                'usuario.usuario_apellidos',
                'usuario.usuario_tipo',//add
                'usuario.usuario_ruc',//add
                'usuario.usuario_razonsocial',//add
                'usuario.usuario_email',//add
                'usuario.usuario_movil',//add
                'usuario.usuario_dni',//add
                'usuario.usuario_id',//add
                'usuario.usuario_escorporativo',//para pruebaaaa
                //'promociones.promocion_nombre',//add
                //'descuentos.descuento_monto',//add
                //'tarjeta.tarjeta_marca',//add
                \DB::raw('CONCAT(usuario.usuario_nombre, " ", usuario.usuario_apellidos) AS usuario_nombre_c'),
                \DB::raw('usuario.usuario_movil AS emisor_celular'),
                \DB::raw('usuario.usuario_email AS emisor_email'),
                \DB::raw('usuario.usuario_dni AS emisor_dni')
            )
          ->whereNotNull('reserva_lockers.locker_id')
          ->where(function ($query) use ($search,$contexto){
            $query->where( 'reserva_lockers.contacto','like','%'.$search.'%');


              // print_r("aaaaaaa");
              // die();
              //$cor=1;
              //$query->where( 'usuario.usuario_escorporativo','like','%'.$cor.'%');
              //$query->where( 'usuario.usuario_escorporativo','=',1);
              //dd($query->get());
              //$query->where('usuario.usuario_escorporativo','=', 1);

            $query->orWhere( 'reserva_lockers.correo','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.celular','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.size','like','%'.$search.'%');
            $query->orWhere( 'reserva_lockers.dni','like','%'.$search.'%');
            //$query->where('usuario.usuario_escorporativo','=', 1);
        });

        if($contexto=='corporativo') {
          $model->where('usuario.usuario_escorporativo','=', 1);
        }

        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
          $model->whereBetween('reserva_lockers.created_at', array($fecha_inicio,$fecha_fin));
        }

        $model = $model->orderBy('id','desc')->paginate($pager);
        return $model;
    }
    /*end search exel*/



    public static function reservaConUsuario($id){

      $model = \DB::table('reserva_lockers')
                   //->join('users', 'users.id', '=', 'reserva_lockers.user_id')
                   ->select('reserva_lockers.*');


        $model = $model->orderBy('id','desc');
        return $model;

    }

    public function locker(){
      return $this->belongsTo(Locker::class, 'locker_id');
    }

    public function usuario(){
      return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function estadoReserva(){

      switch ($this->estado) {
        case 2:
          $cadena = 'Reservado';
          break;
        case 3:
          $cadena = 'Entregado';
          break;
        case 4:
          $cadena = 'Retirado';
          break;
        default:
        $cadena = 'Reserva en Proceso';
          break;
      }
      return $cadena;
    }

    public function sizeCodigo(){
        switch ($this->size) {
            case 'grande':
                $cadena = 3;
                break;
            case 'mediano':
                $cadena = 2;
                break;
            case 'pequeño':
                $cadena = 1;
                break;
            default:
                $cadena = 1;
                break;
        }

        return $cadena;
    }





}
