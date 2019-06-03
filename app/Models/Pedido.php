<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $connection = 'pickapp_api';
    protected $table = 'pedido';
    protected $primaryKey = 'pedido_id';

    protected $guarded = [];

    public static function search($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
          'column-1' =>'pedido_codigo',
          'column-2' =>'pedido_fechacreacion',
          'column-3' =>'pedido_calledesde',
          'column-4' =>'pedido_callehasta',
          'column-5' =>'pedido_nombreemisor',
          'column-6' =>'pedido_nombrereceptor',
          'column-7' =>'pedido_cuantopaga',
          'column-8' =>'pedido_escorporativo',
          'column-9' =>'pedido_estado'
        ];

        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }


        $model = Pedido::where(function ($query) use ($search){
            $query->where( 'pedido_nombreemisor','like','%'.$search.'%');
            $query->where( 'pedido_nombrereceptor','like','%'.$search.'%');
        });

        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
          $model->whereBetween('pedido_fechacreacion', array($fecha_inicio,$fecha_fin));
        }

        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('pedido_fechacreacion','desc')->paginate($pager);
        return $model;
    }




    public static function searchdownloadata($pager,$search,$column,$order,$fecha_inicio=null,$fecha_fin=null){

        $columns = [
          'column-1' =>'pedido_codigo',
          'column-2' =>'pedido_fechacreacion',
          'column-3' =>'pedido_calledesde',
          'column-4' =>'pedido_callehasta',
          'column-5' =>'pedido_nombreemisor',
          'column-6' =>'pedido_nombrereceptor',
          'column-7' =>'pedido_cuantopaga',
          'column-8' =>'pedido_escorporativo',
          'column-9' =>'pedido_estado',
          'column-10' =>'pedido_id'
        ];

        if(!empty($fecha_inicio)){
          $fecha_inicio = urldecode($fecha_inicio);
        }
        if(!empty($fecha_fin)){
          $fecha_fin = urldecode($fecha_fin);
        }


        $model = \DB::connection('pickapp_api')
          ->table('pedido')
          ->leftJoin('usuario', 'pedido.usuario_id', '=', 'usuario.usuario_id')
          ->leftJoin('motivo', 'pedido.motivo_id', '=', 'motivo.motivo_id')
          ->leftJoin('pedidoinfo', 'pedido.pedido_id', '=', 'pedidoinfo.pedido_id')
          // ->leftJoin('referencia_usuario', 'envio_regular.usuario_id', '=', 'referencia_usuario.usuario_id')
          // ->leftJoin('referencia', 'referencia_usuario.referencia_id', '=', 'referencia.id')
          ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'pedido.tarjeta_id')
          ->leftJoin('descuentos', 'descuentos.descuento_transaccion_id', '=', 'pedido.pedido_id')
          ->leftJoin('promociones', 'descuentos.promocion_id', '=', 'promociones.promocion_id')
          ->where(function ($query) use ($search){
            $query->where( 'pedido_nombreemisor','like','%'.$search.'%');
            $query->where( 'pedido_nombrereceptor','like','%'.$search.'%');
            $query->orWhere( 'descuentos.descuento_tipo_servicio','like','pedido');
          })
          ->select(
            'pedido.*',
            'usuario.*',
            // 'referencia.nombre as referencia_nombre',
            'descuentos.descuento_monto as descuento_monto',
            'tarjeta.tarjeta_marca as tarjeta_marca',
            'promociones.promocion_nombre as promocion_nombre',
            'motivo.motivo_descripcion as motivo_descripcion',
            'pedidoinfo.pedido_ruc as pedido_ruc',
            'pedidoinfo.pedido_razonsocial as pedido_razonsocial',
            'pedidoinfo.pedido_emitirfactura as pedido_emitirfactura'
          );





        if(!empty($fecha_inicio)&&!empty($fecha_fin)){
          $model->whereBetween('pedido_fechacreacion', array($fecha_inicio,$fecha_fin));
        }

        if(@$column){
            if(@$columns[$column]){
                $model = $model->orderBy($columns[$column],$order);
            }else{
                abort(404);
            }
        }
        $model = $model->orderBy('pedido_fechacreacion','desc')->paginate($pager);
        return $model;
    }




    public static function reservaConUsuario($id){

      $model = \DB::table('reserva_lockers')
                   //->join('users', 'users.id', '=', 'reserva_lockers.user_id')
                   ->select('reserva_lockers.*');

        $model = $model->orderBy('id','desc');
        return $model;
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





}
