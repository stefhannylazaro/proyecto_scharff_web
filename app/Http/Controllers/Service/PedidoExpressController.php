<?php

namespace App\Http\Controllers\Service;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PedidoExpressController extends Controller
{
    private $directory = 'pedido';
    private $paginate = 10;











    public function admindex($column = null, $order = null){


      $request = request()->all();
      $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
      $search = @$request['search'] ? $request['search'] : null;

      $fecha_inicio = null;
      if(isset($request['filtro_fecha_inicio'])){
        $fecha_inicio = $request['filtro_fecha_inicio'];
      }

      $fecha_fin =  null;
      if(isset($request['filtro_fecha_fin'])){
        $fecha_fin = $request['filtro_fecha_fin'];
      }

      $models = Pedido::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
      $order = ($order == 'asc') ? 'desc' : 'asc';


      return view('admin.' . $this->directory . '.index', compact(
          'models',
          'pager',
          'search',
          'column',
          'order',
          'request',
          'fecha_inicio',
          'fecha_fin'
      ));
    }

    public function admview($id){
      //  $obj = Pedido::reservaConUsuario($id)->get()->first();
      $model = Pedido::find($id);
        //$obj = Pedido::findOrFail($id);
        //print_r($obj);
        return view('admin.' . $this->directory . '.view', compact('model'));
    }




    public function download($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:J1', 'thin');

                $sheet->cells('A1:J1', function ($cells) {
                    $cells->setBackground('#242424');
                    $cells->setFontColor('#fffff8');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->setHeight(array(
                        '1' => '20'
                    )
                );

                $data = [];

                $pager = 10000;
                if(isset($request['column'])){
                  $pager = $request['column'];
                }

                $search =  null;
                if(isset($request['search'])){
                  $search = $request['search'];
                }


                $fecha_inicio = null;
                if(isset($request['fecha_inicio'])){
                  $fecha_inicio = $request['fecha_inicio'];
                }

                $fecha_fin =  null;
                if(isset($request['fecha_fin'])){
                  $fecha_fin = $request['fecha_fin'];
                }

                $cabecera = [
                    'item',
                    'pedido_codigo',
                    'pedido_fechacreacion',
                    'pedido_calledesde',
                    'pedido_callehasta',
                    'pedido_nombreemisor',
                    'pedido_nombrereceptor',
                    'pedido_cuantopaga',
                    'pedido_escorporativo',
                    'pedido_estado',


                ];

                array_push($data, $cabecera);

                $models = Pedido::search($pager, $search, $request['column'], $request['order'], $fecha_inicio, $fecha_fin);
                $reservas = $models->items();
/*
                $reservas = Pedido::where('estado',1)
                  ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
                  ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'reserva_lockers.tarjeta_id')
                  ->leftJoin('lockers', 'lockers.id', '=', 'reserva_lockers.locker_id')
                  ->select('reserva_lockers.*', 'usuario.usuario_nombre',
                  'usuario.usuario_apellidos', 'tarjeta.tarjeta_marca', 'lockers.nombre as locker_nombre')
                  ->orderBy('reserva_lockers.fecha_entrega', 'desc')
                  ->get();
*/

                for ($i = 0; $i < count($reservas); $i++) {
                    $temp = array(
                      $i+1,
                      $reservas[$i]->pedido_codigo,
                      $reservas[$i]->pedido_fechacreacion,
                      $reservas[$i]->pedido_calledesde,
                      $reservas[$i]->pedido_callehasta,
                      $reservas[$i]->pedido_nombreemisor,
                      $reservas[$i]->pedido_nombrereceptor,
                      $reservas[$i]->pedido_cuantopaga,
                      $reservas[$i]->pedido_escorporativo,
                      $reservas[$i]->pedido_estado,


                      /* $reservas[$i]->created_at,
                      $reservas[$i]->fecha_entrega,
                      $reservas[$i]->fecha_reserva*/
                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }

    public function downloaddata($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AR1', 'thin');

                $sheet->cells('A1:AR1', function ($cells) {
                    $cells->setBackground('#242424');
                    $cells->setFontColor('#fffff8');
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->setHeight(array(
                        '1' => '20'
                    )
                );

                $data = [];

                $pager = 1000;
                if(isset($request['column'])){
                  $pager = $request['column'];
                }

                $search =  null;
                if(isset($request['search'])){
                  $search = $request['search'];
                }


                $fecha_inicio = null;
                if(isset($request['filtro_fecha_inicio'])){
                  $fecha_inicio = $request['filtro_fecha_inicio'];
                }

                $fecha_fin =  null;
                if(isset($request['filtro_fecha_fin'])){
                  $fecha_fin = $request['filtro_fecha_fin'];
                }

                $cabecera = [
                  'ID de la transacción',
                  'Fecha de transacción',
                  'Hora de aceptación de pedido',
                  'Empresa',
                  'Id de usuario',
                  'Tipo de usuario',
                  'Nombres',
                  'Apellidos',
                  'Comprobante de pago',
                  'Número de documento',
                  'RUC',
                  'Razón Social',
                  'Km ',
                  'Tarifa cliente regular',
                  'Nombre de promoción',
                  'Descuento',
                  'Tarifa cliente con descuento',
                  'Pago Scharffer',
                  'Comisión Scharff',
                  'Dirección de recojo',
                  'Referencia de recojo',
                  'Instrucciones del recojo',
                  'Contacto de recojo',
                  'Número contacto de recojo',
                  'Ya llegué recojo',
                  'Recojo registrado',
                  'Dirección de entrega',
                  'Referencia de entrega',
                  'Instrucciones del entrega',
                  'Contacto de entrega',
                  'Número contacto de entrega',
                  'Ya llegué entrega',
                  'Hora de entrega',
                  'Estado',
                  'Motivo',
                  'ID scharffer',
                  'Método de pago',
                  'Medio de pago',
                  'Tarjeta',
                  'Código medio de pago',
                  'ESTADO Medio Pago',
                  'Tiempo de aceptación de pedido',
                  'Tiempo de recojo',
                  'Tiempo de entrega'

                ];

                array_push($data, $cabecera);

                $models = Pedido::searchdownloadata($pager, $search, $request['column'], $request['order'], $fecha_inicio, $fecha_fin);
                $reservas = $models->items();
/*
                $reservas = Pedido::where('estado',1)
                  ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
                  ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'reserva_lockers.tarjeta_id')
                  ->leftJoin('lockers', 'lockers.id', '=', 'reserva_lockers.locker_id')
                  ->select('reserva_lockers.*', 'usuario.usuario_nombre',
                  'usuario.usuario_apellidos', 'tarjeta.tarjeta_marca', 'lockers.nombre as locker_nombre')
                  ->orderBy('reserva_lockers.fecha_entrega', 'desc')
                  ->get();
*/


                for ($i = 0; $i < count($reservas); $i++) {

                  $tipousuario = 'Directo';
                  $comprobante = $reservas[$i]->pedido_emitirfactura?'RUC':'BOLETA';
                  $pedido_ruc = $reservas[$i]->pedido_emitirfactura?$reservas[$i]->pedido_ruc:'';
                  $pedido_razonsocial = $reservas[$i]->pedido_emitirfactura?$reservas[$i]->pedido_razonsocial:'';

                    $temp = array(

                      $reservas[$i]->pedido_id,//ID de la transacción
                      $reservas[$i]->pedido_fechacreacion,//Fecha de transacción
                      $reservas[$i]->pedido_fechareserva,//Hora de aceptación de pedido
                      $reservas[$i]->empresa_id,//Empresa
                      $reservas[$i]->usuario_id,//Id de usuario
                      $tipousuario,//Tipo de usuario
                      $reservas[$i]->usuario_nombre,//'Nombres Cliente',
                      $reservas[$i]->usuario_apellidos,//'Apellidos Cliente',
                      $comprobante,//Comprobante de pago--------CREAR
                      $reservas[$i]->usuario_dni,//Número de documento
                      $pedido_ruc,//RUC ----------CREAR
                      $pedido_razonsocial,//Razón Social -------CREAR
                      $reservas[$i]->pedido_distancia,//Km
                      (float)$reservas[$i]->pedido_cuantopaga,//Tarifa cliente regular
                      $reservas[$i]->promocion_nombre,//Nombre de promoción
                      $reservas[$i]->descuento_monto,//Descuento
                      (float)$reservas[$i]->pedido_cuantopaga - (float)$reservas[$i]->descuento_monto,//Tarifa cliente con descuento
                      (float)$reservas[$i]->pedido_cuantopaga - (float)$reservas[$i]->pedido_comision,//Pago Scharffer
                      $reservas[$i]->pedido_comision,//Comisión Scharff
                      $reservas[$i]->pedido_calledesde,//Dirección de recojo
                      $reservas[$i]->pedido_numerocallehasta,//Referencia de recojo
                      $reservas[$i]->pedido_comentarioorigen,//Instrucciones del recojo
                      $reservas[$i]->pedido_nombreemisor,//Contacto de recojo
                      $reservas[$i]->pedido_numeroemisor,//Número contacto de recojo
                      $reservas[$i]->pedido_fechallegada,//Ya llegué recojo
                      $reservas[$i]->pedido_fecharecepcion,//Recojo registrado
                      $reservas[$i]->pedido_callehasta,//Dirección de entrega
                      $reservas[$i]->pedido_referenciahasta,//Referencia de entrega
                      $reservas[$i]->pedido_descripcion,//Instrucciones del entrega
                      $reservas[$i]->pedido_personacontactoreceptor,//Contacto de entrega
                      $reservas[$i]->pedido_numeroreceptor,//Número contacto de entrega
                      $reservas[$i]->pedido_fechallegada,//Ya llegué entrega
                      $reservas[$i]->pedido_fechallegada,//Hora de entrega
                      $reservas[$i]->pedido_estado,//Estado
                      $reservas[$i]->motivo_descripcion,//Motivo
                      $reservas[$i]->pedido_transportistaid,//ID scharffer
                      "",//Método de pago
                      $reservas[$i]->tarjeta_id,//Medio de pago
                      $reservas[$i]->tarjeta_marca,//Tarjeta
                      $reservas[$i]->pedido_tipopago,//Código medio de pago
                      "",//ESTADO Medio Pago
                      "",//Tiempo de aceptación de pedido
                      "",//Tiempo de recojo
                      ""//Tiempo de entrega


                      //
                      // $i+1,
                      // $reservas[$i]->pedido_codigo,
                      // $reservas[$i]->pedido_fechacreacion,
                      // $reservas[$i]->pedido_calledesde,
                      // $reservas[$i]->pedido_callehasta,
                      // $reservas[$i]->pedido_nombreemisor,
                      // $reservas[$i]->pedido_nombrereceptor,
                      // $reservas[$i]->pedido_cuantopaga,
                      // $reservas[$i]->pedido_escorporativo,
                      // $reservas[$i]->pedido_estado,


                      /* $reservas[$i]->created_at,
                      $reservas[$i]->fecha_entrega,
                      $reservas[$i]->fecha_reserva*/
                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }

    public function download_plantilla(){
      $path = public_path() . '/' . 'DATA.xlsx';
      return response()->download($path);
    }

    public function upload_plantilla(Request $request){

      $data = $request->all();
      $dataUpdate = json_decode($data['data']);
      $dataUpdate = array_map(function($tag) {
        $tag[2] = str_replace('/','-',$tag[2]);
        $tag[3] = str_replace('/','-',$tag[3]);
        $tag[4] = str_replace('/','-',$tag[4]);

          return array(
              'id' => @$tag[0]? (int) trim($tag[0]): null,
              'estado' => @$tag[1]? trim($tag[1]): null,
              'fecha_entrega' => @$tag[2]? trim($tag[2]): null,
              'fecha_recojo' => @$tag[3]? trim($tag[3]): null,
              'fecha_reserva' => @$tag[4]? trim($tag[4]): null,
              'codigo_recojo' => @$tag[5]? trim($tag[5]): null
          );
      }, $dataUpdate);

      $mensajes = [];


      for ($i = 0; count($dataUpdate) > $i; $i++){
        $tmp = $dataUpdate[$i];
        if (@$tmp['id']){
          ReservaLocker::where('id', $tmp['id'])
            ->update($tmp);
        } else {
          array_push($mensajes, $i + 2);
        }
      }

      $msj = '';
      $estado = 0;
      if ($mensajes) {
        $msj = 'El/Los registro(s) del excel : [' . implode($mensajes, ',') . '] no fueron actualizados.';
        $estado = 1;
      }else{
        $msj = 'El/Los registro(s) de excel fueron actualizados.';
      }

      return response()->json(['estado'=> $estado, 'mensaje' => $msj,'data'=>$dataUpdate]);
    }
}
