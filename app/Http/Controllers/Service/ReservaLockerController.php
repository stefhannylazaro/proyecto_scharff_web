<?php

namespace App\Http\Controllers\Service;

use App\Models\ReservaLocker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ReservaLockerController extends Controller
{
    private $directory = 'reserva';
    private $paginate = 10;

    public function userReservas(Request $request){

        $user_id = $request->user_id;
        $data = [];

        if(empty($user_id)){
          $data_respuesta = [
              'status' => 0,
              'error' => 'No user found',
              'data' => $data
          ];
          return response()->json($data_respuesta);
        }


        $reserva_lockers = \DB::table('reserva_lockers')
            ->select(\DB::raw('id,estado,fecha_entrega,contacto,dni,correo,celular,fecha_recojo,total_pagado'))
            ->where('user_id', $user_id)->orderBy('id', 'DESC')
            ->get()->toArray();

        $data_respuesta =  [
            'status' => 0,
            'error' => 'No existe data',
            'data' => $data
        ];




        if (count($reserva_lockers) > 0){
            $data_respuesta['status'] = 1;
            $data_respuesta['error'] = '';
            $data_respuesta['data'] = $reserva_lockers;
        }

        return response()->json($data_respuesta);
    }





    public function create(Request $request){

        $data = $request->all();

        $data['fecha_entrega']=date('Y-m-d H:i');
        $data['fecha_recojo']=date('Y/m/d H:i');

        $datetime = new \DateTime('tomorrow');
        $data['fecha_recojo'] =  $datetime->format('Y-m-d H:i:');


        $reservaLocker =  ReservaLocker::create($data);

        //$reservaLocker['fecha_entrega']=date('Y-m-d H:i:s');
        //$reservaLocker['fecha_recojo']=date('Y/m/d H:i');
        $data_respuesta =  [
            'status' => 0,
            'data' => 'Error al guardar',
        ];

        if($reservaLocker){
          $data_respuesta =  [
              'status' => 1,
              'data' => 'Se guardo con exito',
          ];
        };

        return response()->json($data_respuesta);


    }




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

      $models = ReservaLocker::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);





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
      //  $obj = ReservaLocker::reservaConUsuario($id)->get()->first();
      $model = ReservaLocker::find($id);
        //$obj = ReservaLocker::findOrFail($id);
        //print_r($obj);
        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function admview_update($id, Request $request){
        $data = $request->all();

        $reserva = ReservaLocker::findOrFail($id);

        $reserva->fill($data);
        $reserva->save();

        return redirect()->route('adm.reserva.view' , $id)->with('mensaje','Reserva actualizada con éxito!!');;
    }

    public function nombreEstado($estado_key){

      $estados = ['',
        'RESERVA SOLICITADA',
        'PAQUETE RECOGIDO',
        'RESERVA CONFIRMADA',
        'RESERVA RECHAZADA',
        'ENTREGADA (CLIENTE)',
        'ENTREGA SCHARFF',
        'RETIRADA (CLIENTE)',
        'RETIRO SCHARFF',
        'CANCELADA POR RETIRAR',
        'CANCELADA',
        'ENTREGA VENCIDA',
        'RECOJO VENCIDO POR RETIRAR',
        'RECOJO VENCIDO RETIRADO',
        'ENTREGADA EN DOMICILIO'
      ];
      if(isset($estados[$estado_key])){
        return $estados[$estado_key];
      }else{
        return "";
      }
    }




    public function download($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AQ1', 'thin');

                $sheet->cells('A1:AQ1', function ($cells) {
                  $cells->setBackground('#f7b27d');
                  $cells->setFontColor('#333333');
                  $cells->setAlignment('center');
                  $cells->setValignment('center');
                });

                $sheet->setHeight(array(
                        '1' => '20'
                    )
                );

                $data = [];

                $pager = 10000;
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

                $column = null;
                if(isset($request['column'])){
                  $column = $request['column'];
                }

                $order =  null;
                if(isset($request['order'])){
                  $order = $request['order'];
                }



                $cabecera=[
                  'ID transacción',
                  'ID Operación Boxeway',
                  'Fecha Solicitud ',
                  'Fecha de Reserva',
                  'Id Cliente',
                  'Tipo de usuario',
                  'Nombres Cliente',
                  'Apellidos Cliente',
                  'Correo cliente',
                  'DNI cliente',
                  'Comprobante de pago',
                  'RUC',
                  'Razón Social',
                  'Tamaño Locker',
                  'Formato Stop',
                  'Id Ubicación Locker',
                  'Ubicación Locker',
                  'Descripción de producto',
                  'Plazo Reserva',
                  'Estado',
                  'Tipo de Retiro',
                  'Nombres y apellidos destinatario',
                  'Correo destinatario',
                  'DNI destinatario',
                  'Celular destinatario',
                  'Dirección de destino',
                  'Provincia de destino',
                  'Departamento de destino',
                  'Locker de destino',
                  'Fch. Vcto. Entrega',
                  'Fch. Vcto. Recojo',
                  'Fecha Entrega',
                  'Fecha Retiro',
                  'Tiempo de entrega',
                  'Tiempo de retiro',
                  'Tarifa cliente regular',
                  'Nombre de promoción',
                  'Descuento',
                  'Tarifa cliente con descuento',
                  'Medio de pago',
                  'Tarjeta',
                  'Código Medio Pago',
                  'ESTADO Medio Pago'
                ];

                array_push($data, $cabecera);

                $models = ReservaLocker::searchDownloadData($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $reservas = $models->items();


                for ($i = 0; $i < count($reservas); $i++) {
                  $comprobante = '';
                  if($reservas[$i]->emitir_factura==1){
                    $comprobante = 'RUC';
                  }else if($reservas[$i]->emitir_factura==0){
                    $comprobante = 'BOLETA';
                  }
                  $ruc = $reservas[$i]->emitir_factura?$reservas[$i]->reserva_ruc:'';
                  $reserva_razonsocial = $reservas[$i]->emitir_factura?$reservas[$i]->reserva_razonsocial:'';

                  $descuento_monto = $reservas[$i]->descuento_monto?$reservas[$i]->descuento_monto:0;

                  $tipousuario = $reservas[$i]->referencia_nombre?$reservas[$i]->referencia_nombre:"Directo";
                  $estadoname = $this->nombreEstado($reservas[$i]->estado);
                    $temp = array(
                      $reservas[$i]->id,//ID transacción
                      "",//ID Operación Boxeway
                      $reservas[$i]->created_at,//Fecha Solicitud
                      $reservas[$i]->fecha_reserva,//Fecha de Reserva
                      $reservas[$i]->usuario_id,//Id Cliente
                      $tipousuario,//Tipo de usuario
                      $reservas[$i]->usuario_nombre,//Nombres Cliente
                      $reservas[$i]->usuario_apellidos,//Apellidos Cliente
                      $reservas[$i]->emisor_email,//Correo cliente
                      $reservas[$i]->emisor_dni,//DNI cliente
                      $comprobante,//Comprobante de pago
                      $ruc,//RUC
                      $reserva_razonsocial,//Razón Social
                      $reservas[$i]->size,//Tamaño Locker
                      'Locker',//Formato Stop
                      $reservas[$i]->locker_id,//Id Ubicación Locker
                      $reservas[$i]->locker_nombre,//Ubicación Locker
                      $reservas[$i]->articulo,//Descripción de producto
                      "",//Plazo Reserva ADD: plazo_reserva
                      $estadoname,//Estado
                      "",//Tipo de Retiro ADD: tipo_retiro
                      $reservas[$i]->contacto,//Nombres y apellidos destinatario
                      $reservas[$i]->correo,//Correo destinatario
                      $reservas[$i]->dni,//DNI destinatario
                      $reservas[$i]->celular,//Celular destinatario
                      "",//Dirección de destino ADD: direccion_destino
                      "",//Provincia de destino ADD: provincia_destino
                      "",//Departamento de destino ADD: departamento_destino
                      $reservas[$i]->locker_nombre,//Locker de destino ADDDDDD: locker_destino
                      "",//Fch. Vcto. Entrega ADD: fecha_vencimiento_entrega
                      "",//Fch. Vcto. Recojo ADD: fecha_vencimiento_recojo
                      $reservas[$i]->fecha_entrega,//Fecha Entrega
                      $reservas[$i]->fecha_recojo,//Fecha Retiro
                      $reservas[$i]->tiempo_espera_entrega,//Tiempo de entrega
                      $reservas[$i]->tiempo_espera_recojo,//Tiempo de retiro
                      (float)$reservas[$i]->total_pagado+$reservas[$i]->descuento_monto,//Tarifa cliente regular
                      $reservas[$i]->promocion_nombre,//Nombre de promoción
                      $descuento_monto,//Descuento
                      $reservas[$i]->total_pagado,//Tarifa cliente con descuento
                      "Culqi",//Medio de pago ADD: medio_pago
                      $reservas[$i]->tarjeta_marca,//Tarjeta
                      $reservas[$i]->codigo_culqi_pago,//Código Medio Pago
                      $reservas[$i]->estado_medio_pago,//ESTADO Medio Pago


                      // id_op_boxeway
                      // plazo_reserva
                      // tipo_retiro
                      // direccion_destino
                      // provincia_destino
                      // departamento_destino
                      // fecha_vencimiento_entrega
                      // fecha_vencimiento_recojo
                      // medio_pago

                    );
                    array_push($data, $temp);
                };




                $sheet->rows($data);
            });
        })->export('xlsx');
    }

    /*Download data sistema*/
    public function downloadsistemas($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:V1', 'thin');

                $sheet->cells('A1:V1', function ($cells) {
                  $cells->setBackground('#242424');
                  $cells->setFontColor('#fffff8');
                  $cells->setAlignment('center');
                  $cells->setValignment('center');
                });

                // Format a range with e.g. leading zeros
                $sheet->setColumnFormat(array(
                    'A' => 'General',
                    'B' => '@',
                    'C' => 'yyyy-mm-dd',
                    'D' => '@',
                    'E' => '@',
                    'F' => '@',
                    'G' => '@',
                    'H' => '@',
                    'I' => '@',
                    'J' => 'General',
                    'K' => 'General',
                    'L' => 'General',
                    'M' => 'General',
                    'N' => 'General',
                    'O' => 'General',
                    'P' => 'General',
                    'Q' => 'General',
                    'R' => 'General',
                    'S' => 'General',
                    'T' => 'General',
                    'U' => 'General',
                    'V' => 'General'
                ));
                
                $sheet->setHeight(array(
                        '1' => '20'
                    )
                );

                $data = [];

                $pager = 10000;
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

                $column = null;
                if(isset($request['column'])){
                  $column = $request['column'];
                }

                $order =  null;
                if(isset($request['order'])){
                  $order = $request['order'];
                }

                $cabecera=[
                  'ITEM',
                  'REMITENTE',
                  'CODIGO_PAQUETE',
                  'NRO_ORDEN',//NRO_RESERVA
                  'TOTAL_PQTE',
                  'NRO_PQTE',
                  'LOCKER_TAMAÑO',
                  'ELOCKER_DESTINO',
                  'REMITENTE_SERVICIO',
                  'RECOJO_SEDE',
                  'RECOJO_FECHA',
                  'RECOJO_TURNO',
                  'CLIENTE_NOMBRE',
                  'CLIENTE_EMAIL',
                  'CLIENTE_CELULAR',
                  'CLIENTE_COMENTARIO',
                  'PRODUCTO',
                  'EMISOR_NOMBRE',
                  'EMISOR_EMAIL',
                  'EMISOR_CELULAR',
                  'NRO_DOC',
                  'ID_USUARIO'
                ];

                array_push($data, $cabecera);

                $models = ReservaLocker::searchDownloadSistemas($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $reservas = $models->items();


                for ($i = 0; $i < count($reservas); $i++) {
                    switch ($reservas[$i]->size) {
                      case 'pequeño':
                        $size_block=1;
                        break;
                      case 'mediano':
                        $size_block=2;
                        break;
                      case 'grande':
                        $size_block=3;
                        break;
                      default:
                        $size_block='';
                        break;
                    }
                    $temp = array(
                      $i+1,// 'ITEM'
                      $reservas[$i]->usuario_nombre_c,// 'REMITENTE'
                      '',// 'CODIGO_PAQUETE'
                      $reservas[$i]->id,// 'NRO_RESERVA'
                      '1',// 'TOTAL_PQTE'
                      '1',// 'NRO_PQTE'
                      $size_block,//Tamaño Locker
                      $reservas[$i]->codigo_referencial,//'LOCKER DE DESTINO',(colocar id locker)
                      '',// 'REMITENTE_SERVICIO'
                      '',// 'RECOJO_SEDE'
                      $reservas[$i]->fecha_recojo,// 'RECOJO_FECHA'
                      '',// 'RECOJO_TURNO'

                      $reservas[$i]->contacto,// 'CLIENTE_NOMBRE'(destinatario)
                      $reservas[$i]->correo,// 'CLIENTE_EMAIL'
                      $reservas[$i]->celular,// 'CLIENTE_CELULAR'

                      '',// 'CLIENTE_COMENTARIO'
                      $reservas[$i]->articulo,// 'PRODUCTO'
                      $reservas[$i]->usuario_nombre_c,// 'EMISOR_NOMBRE'
                      $reservas[$i]->usuario_email,// 'EMISOR_EMAIL'
                      $reservas[$i]->usuario_movil,// 'EMISOR_CELULAR'
                      $reservas[$i]->usuario_dni,// 'NRO_DOC'
                      $reservas[$i]->usuario_id,// 'ID_USUARIO'


                    );
                    array_push($data, $temp);
                };




                $sheet->rows($data);
            });
        })->export('xlsx');
    }
    /*End Download data sistema*/




    /*Download transacciones cliente coorporativos*/
    public function downloadcorporativo($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:P1', 'thin');

                $sheet->cells('A1:P1', function ($cells) {
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

                $column = null;
                if(isset($request['column'])){
                  $column = $request['column'];
                }

                $order =  null;
                if(isset($request['order'])){
                  $order = $request['order'];
                }


                $cabecera=[
                  'Id Cliente',
                  'Cliente',
                  'Fecha de registro',
                  'ID Operación Boxeway',
                  'Código paquete',
                  'Orden pedido',
                  'Reetiquetado',
                  'Tamaño locker',
                  'Locker',
                  'Correo cliente',
                  'Celular',
                  'Entrega en locker',
                  'Fch. Vcto. Recojo',
                  'Retiro en locker',
                  'Estado',
                  'Tiempo de entrega',
                  'Tiempo de retiro'
                ];

                array_push($data, $cabecera);

                $models = ReservaLocker::searchDownloadSistemas($pager, $search, $column, $order, $fecha_inicio, $fecha_fin,'corporativo');
                $reservas = $models->items();
                // print_r("aaaaaaa");
                // die();

                for ($i = 0; $i < count($reservas); $i++) {

                    $temp = array(
                      $reservas[$i]->usuario_id,
                      $reservas[$i]->usuario_nombre_c,// 'Cliente',
                      $reservas[$i]->fecha_reserva,// 'Fecha de registro',
                      "",// 'ID Operación Boxeway',
                      '',// 'Código paquete',
                      '',// 'Orden pedido',
                      '',// 'Reetiquetado',
                      $reservas[$i]->size,// 'Tamaño locker',
                      $reservas[$i]->lockers_nombre,// 'Locker'
                      $reservas[$i]->correo,// 'Correo cliente' (destinatarioa)
                      $reservas[$i]->celular,// 'Celular'(destinatario)
                      $reservas[$i]->fecha_entrega,// 'Fecha Entrega en locker',
                      '',// 'Fecha. Vcto. Recojo',
                      $reservas[$i]->fecha_recojo,// 'Fecha Retiro en locker',
                      $reservas[$i]->estado,// 'Estado',
                      $reservas[$i]->tiempo_espera_entrega,// 'Tiempo de entrega'(duracion)
                      $reservas[$i]->tiempo_espera_recojo// 'Tiempo de retiro' (duracion)

                    );
                    array_push($data, $temp);
                };

                $sheet->rows($data);
            });
        })->export('xlsx');
    }
    /*End Download transacciones cliente coorporativos*/





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
