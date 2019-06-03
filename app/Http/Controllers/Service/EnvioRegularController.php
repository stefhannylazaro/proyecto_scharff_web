<?php

namespace App\Http\Controllers\Service;

use App\Models\EnvioRegular;
use App\Models\UbigeosScharff;
use App\Models\Usuario;
//use App\Models\Opciones;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class EnvioRegularController extends Controller
{
    private $directory = 'regular';
    private $paginate = 10;


    public function admindex($column = null, $order = null){

      $request = request()->all();


      $fecha_inicio = null;
      if(isset($request['filtro_fecha_inicio'])){
        $fecha_inicio = $request['filtro_fecha_inicio'];
      }

      $fecha_fin =  null;
      if(isset($request['filtro_fecha_fin'])){
        $fecha_fin = $request['filtro_fecha_fin'];
      }

      $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
      $search = @$request['search'] ? $request['search'] : null;
      $models = EnvioRegular::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
      //$models = EnvioRegular::searchConUsuarios($pager, $search, $column, $order);

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
      $model = EnvioRegular::findConUsuario($id);
      //$model = EnvioRegular::find($id);
      switch ($model->tiempo) {
        case '0':
          $model->tiempo='24h';
          break;
        case '1':
          $model->tiempo='72h';
          break;
        case '2':
          $model->tiempo='72h+';
          break;
        default:
            $model->tiempo='';
          break;
      }

      return view('admin.' . $this->directory . '.view', compact('model'));
    }

    public function admview_update($id, Request $request){
        $data = $request->all();

        $reserva = EnvioRegular::findOrFail($id);
        $modelUsuario = Usuario::findOrFail($reserva->usuario_id);
        $email=$modelUsuario->usuario_email;

        $info['link']= 'https://www.holascharff.com/#tracking_'.$data["regular_codetracking"];
        $info['regular_codetracking']= $data["regular_codetracking"];

        if(!empty($data["regular_codetracking"]) && $reserva->regular_codetracking!=$data["regular_codetracking"]){
          Mail::send('email.rastreo_regular', ['obj' => $info], function ($m) use ($email) {
              $m->to($email)->subject('Hazle seguimiento a tu envío');
          });
        }
        $reserva->fill($data);
        $reserva->save();


        return redirect()->route('adm.regular.view' , $id)->with('mensaje','Envío actualizada con éxito!!');;
    }



    public function downloadsistemas($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AU1', 'thin');

                $sheet->cells('A1:AU1', function ($cells) {
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

                // $cabecera = [
                //   'Nro ENVIO',
                //   'ORIGEN_CALLE',
                //   'ORIGEN_DIRECCION',
                //   'ORIGEN_INTERIOR',
                //   'ORIGEN_REFERENCIA',
                //   'ORIGEN_REMITENTE',
                //   'ORIGEN_CELULAR',
                //   'DESTINO_CALLE',
                //   'DESTINO_DIRECCION',
                //   'DESTINO_INTERIOR',
                //   'DESTINO_REFERENCIA',
                //   'DESTINO_REMITENTE',
                //   'DESTINO_CELULAR',
                //   'ANCHO',
                //   'ALTURA',
                //   'PROFUNDIDAD',
                //   'PESO',
                //   'TIEMPO',
                //   'COSTO_TOTAL',
                //   'CUPON_DESCUENTO',
                //   'TARJETA_ID',
                //   'USUARIO_ID'
                // ];



                //codigo_ciudad_origen
                //codigo_ciudad_destino
                //destino_pais
                //zona
                // distrito
                // provincia
                // departamento
                // peso_volumetrico
                $cabecera2 = [
                'GUIA_ITEM',//$i + 1,
                'GUIA_N_REF',//$reservas[$i]->id,(numero de guia scharff)
                'GUIA_ORI',//$reservas[$i]->codigo_ciudad_origen
                'GUIA_DEST',//$reservas[$i]->codigo_ciudad_destino
                'GUIA_FECHA',//$reservas[$i]->FECHA_RECOJO//AÑADIR-editar
                'G_SHI_COD',//$reservas[$i]->CODIGO_REMITENTE//AÑADIR-fijo=01171490
                'G_SHI_SUC',//$reservas[$i]->CODIGO_SUCURSAL_REMITENTE
                'G_SHI_CTC',//$reservas[$i]->CONTACTO_SUCURSAL_REMITENTE-editar
                'G_SHI_DIR1',//$reservas[$i]->DIRECCION_SUCURSAL_REMITENTE-editar
                'G_SHI_DIR2',//$reservas[$i]->REFERENCIA_SUCURSAL_REMITENTE-editar
                'G_CON_COD',//$reservas[$i]->CODIGO_DESTINATARIO-editar
                'G_CON_SUC',//$reservas[$i]->CODIGO_SUCURSAL_DESTINATARIO-editar
                'G_CON_CIA',//$reservas[$i]->destino_remitente//COMPAÑIA
                'G_CON_DIR1',//$reservas[$i]->destino_calle
                'G_CON_DIR2',//$reservas[$i]->destino_referencia
                'G_CON_PAIS',//$reservas[$i]->destino_pais
                'G_CON_CIU',//$reservas[$i]->codigo_ciudad_destino
                'G_CON_POST',//$reservas[$i]->CODIGO_POSTAL//editar
                'G_PQT_TIP',//$reservas[$i]->NACIONAL_INTERNACIONAL//editar
                'G_PQT_EMB',//$reservas[$i]->TIPO_EMBALAJE//editar
                'G_PQT_DES',//$reservas[$i]->TIPO_USUARIO//editar
                'G_PQT_NRO',//$reservas[$i]->tiempo+$reservas[$i]->ZONA//editar
                'G_PQT_PESO',//$reservas[$i]->peso
                'G_CTA_REF',//$reservas[$i]->CUENTA_CLIENTE_REFERENCIA//editar
                'G_REFER',//$reservas[$i]->CODIGO_REFERENCIA//editar
                'G_CON_CTC',////$reservas[$i]->NOMBRE_CONTACTO_REFERENCIA//editar
                'G_REF_MON',//$reservas[$i]->TIPO_MONEDA
                'G_REF_IMP',//$reservas[$i]->IMPORTE_CHEQUES
                'G_AGE_COD',//$reservas[$i]->CODIGO_AGENCIA
                'G_AGE_SUC',//$reservas[$i]->CODIGO_SUCURSAL_AGENCIA
                'G_CON_TELF',//$reservas[$i]->destino_celular
                'G_UBI_DIST',//$reservas[$i]->distrito
                'G_UBI_PROV',//$reservas[$i]->provincia
                'G_UBI_DPTO',//$reservas[$i]->departamento
                'G_REF_EST',//$reservas[$i]->origen_referencia
                'G_REF_TIPO',//$reservas[$i]->SEGUNDO_origen_referencia
                'G_UBI_ORIG',//$reservas[$i]->origen_ubigeo//api
                'G_UBI_DEST',//$reservas[$i]->destino_ubigeo//api
                'G_TIP_TRAN',//$reservas[$i]->TIPO_TRANSPORTE//editar
                'G_RUTA',////VACIOOOOOOOOOOO
                'G_MASTER',//NUMERO_GUIA_MASTER
                'G_IND_MAST',//VACIOOOOOOOOOOO
                'PQT_ADIC',//$reservas[$i]->DATOS_ADICIONALES_ENVIO//editar
                'G_RANGO',//$reservas[$i]->HORARIO_COORDINACION_ENTREGA//editar
                'G_TPAGO',//$reservas[$i]->TIPO_PAGO//editar
                'G_PESO_VOL',//$reservas[$i]->peso_volumetrico
                'CONTENIDO'
                ];





                //
                // CODIGO_CIUDAD_ORIGEN
                // CODIGO_CIUDAD_DESTINO
                // DESTINO_PAIS
                // CODIGO_CIUDAD_DESTINO
                // ZONA
                // DISTRITO
                // PROVINCIA
                // DEPARTAMENTO
                // PESO_VOLUMETRICO









                array_push($data, $cabecera2);

                $models = EnvioRegular::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $reservas = $models->items();
                /*
                  $reservas = ReservaLocker::where('estado',1)
                  ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
                  ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'reserva_lockers.tarjeta_id')
                  ->leftJoin('lockers', 'lockers.id', '=', 'reserva_lockers.locker_id')
                  ->select('reserva_lockers.*', 'usuario.usuario_nombre',
                  'usuario.usuario_apellidos', 'tarjeta.tarjeta_marca', 'lockers.nombre as locker_nombre')
                  ->orderBy('reserva_lockers.fecha_entrega', 'desc')
                  ->get();
                */

                for ($i = 0; $i < count($reservas); $i++) {

                  if($reservas[$i]->fecha_recojo!=""){
                    $fechaRecojo=date("d/m/Y", strtotime($reservas[$i]->fecha_recojo));
                  } else {
                    $fechaRecojo='';
                  }
                  if(isset($reservas[$i]->origen_documento)) {
                    $datosRemitente='('.$reservas[$i]->origen_documento.') '.$reservas[$i]->origen_remitente;
                  } else {
                    $datosRemitente=$reservas[$i]->origen_remitente;
                  }
                  $descripcion=$reservas[$i]->regular_contenido;
                    $temp = array(
                        // $i + 1,
                        // $reservas[$i]->origen_calle,
                        // //$reservas[$i]->origen_ubigeo,
                        // $reservas[$i]->origen_direccion_full,
                        // $reservas[$i]->origen_interior,
                        // $reservas[$i]->origen_referencia,
                        // $reservas[$i]->origen_remitente,
                        // $reservas[$i]->origen_celular,
                        // $reservas[$i]->destino_calle,
                        // //$reservas[$i]->destino_ubigeo,
                        // $reservas[$i]->destino_direccion_full,
                        // $reservas[$i]->destino_interior,
                        // $reservas[$i]->destino_referencia,
                        // $reservas[$i]->destino_remitente,
                        // $reservas[$i]->destino_celular,
                        // $reservas[$i]->ancho,
                        // $reservas[$i]->altura,
                        // $reservas[$i]->profundidad,
                        // $reservas[$i]->peso,
                        // $reservas[$i]->tiempo,
                        // $reservas[$i]->costo_total,
                        // $reservas[$i]->cupon_descuento,
                        // $reservas[$i]->tarjeta_id,
                        // $reservas[$i]->usuario_id,


                        $i + 1,/////-----'GUIA_ITEM
                        $reservas[$i]->codigo_correlativo,/////-----'GUIA_N_REF
                        substr($reservas[$i]->codigo_ciudad_origen, 2),/////-----'GUIA_ORI //
                        substr($reservas[$i]->codigo_ciudad_destino, 2),/////-----'GUIA_DEST
                        $fechaRecojo,//$reservas[$i]->FECHA_RECOJO//AÑADIR-editar/////-----'GUIA_FECHA  ;
                        '01171490',//$reservas[$i]->CODIGO_REMITENTE//AÑADIR-fijo=01171490/////-----'G_SHI_COD
                        '',//$reservas[$i]->CODIGO_SUCURSAL_REMITENTE/////-----'G_SHI_SUC
                        $datosRemitente,//CONTACTO_SUCURSAL_REMITENTE-editar/////-----'G_SHI_CTC
                        $reservas[$i]->origen_calle,//DIRECCION_SUCURSAL_REMITENTE-editar/////-----'G_SHI_DIR1
                        $reservas[$i]->origen_referencia,//REFERENCIA_SUCURSAL_REMITENTE-editar/////-----'G_SHI_DIR2
                        '',//$reservas[$i]->CODIGO_DESTINATARIO-editar/////-----'G_CON_COD
                        '',//$reservas[$i]->CODIGO_SUCURSAL_DESTINATARIO-editar/////-----'G_CON_SUC
                        $reservas[$i]->destino_remitente,//COMPAÑIA/////-----'G_CON_CIA
                        $reservas[$i]->destino_calle,/////-----'G_CON_DIR1
                        'Observación:'.$reservas[$i]->destino_referencia."\n\rInterior: ".$reservas[$i]->destino_interior,/////-----'G_CON_DIR2
                        $reservas[$i]->destino_pais,/////-----'G_CON_PAIS
                        substr($reservas[$i]->codigo_ciudad_destino, 2),///-----'G_CON_CIU
                        $reservas[$i]->codigo_postal,//$reservas[$i]->CODIGO_POSTAL//editar/////-----'G_CON_POST
                        2,//$reservas[$i]->NACIONAL_INTERNACIONAL//editar/////-----'G_PQT_TIP
                        $reservas[$i]->tipo_embalaje,//$reservas[$i]->TIPO_EMBALAJE//editar/////-----'G_PQT_EMB
                        $descripcion,//$reservas[$i]->TIPO_EMBALAJE//editar/////-----'G_PQT_DES
                        $reservas[$i]->tiempo,//+$reservas[$i]->ZONA//editar/////-----'G_PQT_NRO
                        $reservas[$i]->peso,/////-----'G_PQT_PESO
                        $reservas[$i]->usuario_id,//CUENTA_CLIENTE_REFERENCIA//editar/////-----'G_CTA_REF
                        '',//$reservas[$i]->CODIGO_REFERENCIA//editar/////-----'G_REFER
                        $reservas[$i]->destino_remitente,//NOMBRE_CONTACTO_REFERENCIA//editar/////-----'G_CON_CTC
                        '',//$reservas[$i]->TIPO_MONEDA/////-----'G_REF_MON
                        '',//$reservas[$i]->IMPORTE_CHEQUES/////-----'G_REF_IMP
                        '',//$reservas[$i]->CODIGO_AGENCIA/////-----'G_AGE_COD
                        '',//$reservas[$i]->CODIGO_SUCURSAL_AGENCIA/////-----'G_AGE_SUC
                        $reservas[$i]->destino_celular,/////-----'G_CON_TELF
                        $reservas[$i]->distrito,/////-----'G_UBI_DIST
                        $reservas[$i]->provincia,/////-----'G_UBI_PROV
                        $reservas[$i]->departamento,/////-----'G_UBI_DPTO
                        '',//$reservas[$i]->origen_referencia,/////-----'G_REF_EST
                        '',//$reservas[$i]->SEGUNDO_origen_referencia/////-----'G_REF_TIPO
                        $reservas[$i]->origen_ubigeo,//api/////-----'G_UBI_ORIG
                        $reservas[$i]->destino_ubigeo,//api/////-----'G_UBI_DEST
                        '',//$reservas[$i]->TIPO_TRANSPORTE//editar/////-----'G_TIP_TRAN
                        '',////VACIOOOOOOOOOOO/////-----'G_RUTA
                        '',//NUMERO_GUIA_MASTER/////-----'G_MASTER
                        '',//VACIOOOOOOOOOOO/////-----'G_IND_MAST
                        '',//$reservas[$i]->DATOS_ADICIONALES_ENVIO//editar/////-----'PQT_ADIC
                        '',//$reservas[$i]->HORARIO_COORDINACION_ENTREGA//editar/////-----'G_RANGO
                        '',//$reservas[$i]->TIPO_PAGO//editar/////-----'G_TPAGO
                        $reservas[$i]->peso_volumetrico,//i//]->PESO_VOLUMETRICO//api/////-----'G_PESO_VOL
                        $reservas[$i]->regular_contenido




                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }




    public function download($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:BC1', 'thin');

                $sheet->cells('A1:BC1', function ($cells) {
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

                $cabecera = [
                  'ID de la transacción',
                  'Fecha de transacción',
                  'Id Cliente',
                  'Tipo de usuario',
                  'Nombres Cliente',
                  'Apellidos Cliente',
                  'Correo cliente',
                  'DNI cliente',
                  'Comprobante de pago',
                  'RUC',
                  'Razón Social',
                  'Tipo Origen',
                  'Id Origen Punto Scharff',
                  'Origen Calle (Dirección)',
                  'Origen Departamento',
                  'Origen Provincia',
                  'Origen Distrito',
                  'Origen interior',
                  'Origen observación',
                  'Remitente Nombres y Apellido',
                  'Remitente Celular',
                  'Tipo Origen',
                  'Id Destino Punto Scharff',
                  'Destino Calle (Dirección)',
                  'Destino Departamento',
                  'Destino Provincia',
                  'Destino Distrito',
                  'Destino interior',
                  'Destino observación',
                  'Destinatario Nombres y Apellido',
                  'Destinatario Celular',
                  'Ancho (cm)',
                  'Altura (cm)',
                  'Profundidad (cm)',
                  'Peso (kg)',
                  'Valor paquete',
                  'Tipo paquete',
                  'Cantidad',
                  'Peso volumétrico (KG)',
                  'Tiempo de entrega',
                  'Seguro',
                  'Ubigeo Origen',
                  'Ubigeo Destino',
                  'Tarifa cliente regular',
                  'Fecha de recojo',
                  'Horario de recojo',
                  'Nombre de promoción',
                  'Descuento',
                  'Tarifa cliente con descuento',
                  'Método de pago',
                  'Medio de pago',
                  'Tarjeta',
                  'Código Medio Pago',
                  'Estado Medio de Pago',
                  'Contenido'
                ];



                //codigo_ciudad_origen
                //codigo_ciudad_destino
                //destino_pais
                //zona
                // distrito
                // provincia
                // departamento
                // peso_volumetrico
                // $cabecera2 = [
                // 'GUIA_ITEM',//$i + 1,
                // 'GUIA_N_REF',//$reservas[$i]->id,(numero de guia scharff)
                // 'GUIA_ORI',//$reservas[$i]->codigo_ciudad_origen
                // 'GUIA_DEST',//$reservas[$i]->codigo_ciudad_destino
                // 'GUIA_FECHA',//$reservas[$i]->FECHA_RECOJO//AÑADIR-editar
                // 'G_SHI_COD',//$reservas[$i]->CODIGO_REMITENTE//AÑADIR-fijo=01171490
                // 'G_SHI_SUC',//$reservas[$i]->CODIGO_SUCURSAL_REMITENTE
                // 'G_SHI_CTC',//$reservas[$i]->CONTACTO_SUCURSAL_REMITENTE-editar
                // 'G_SHI_DIR1',//$reservas[$i]->DIRECCION_SUCURSAL_REMITENTE-editar
                // 'G_SHI_DIR2',//$reservas[$i]->REFERENCIA_SUCURSAL_REMITENTE-editar
                // 'G_CON_COD',//$reservas[$i]->CODIGO_DESTINATARIO-editar
                // 'G_CON_SUC',//$reservas[$i]->CODIGO_SUCURSAL_DESTINATARIO-editar
                // 'G_CON_CIA',//$reservas[$i]->destino_remitente//COMPAÑIA
                // 'G_CON_DIR1',//$reservas[$i]->destino_calle
                // 'G_CON_DIR2',//$reservas[$i]->destino_referencia
                // 'G_CON_PAIS',//$reservas[$i]->destino_pais
                // 'G_CON_CIU',//$reservas[$i]->codigo_ciudad_destino
                // 'G_CON_POST',//$reservas[$i]->CODIGO_POSTAL//editar
                // 'G_PQT_TIP',//$reservas[$i]->NACIONAL_INTERNACIONAL//editar
                // 'G_PQT_EMB',//$reservas[$i]->TIPO_EMBALAJE//editar
                // 'G_PQT_DES',//$reservas[$i]->TIPO_USUARIO//editar
                // 'G_PQT_NRO',//$reservas[$i]->tiempo+$reservas[$i]->ZONA//editar
                // 'G_PQT_PESO',//$reservas[$i]->peso
                // 'G_CTA_REF',//$reservas[$i]->CUENTA_CLIENTE_REFERENCIA//editar
                // 'G_REFER',//$reservas[$i]->CODIGO_REFERENCIA//editar
                // 'G_CON_CTC',////$reservas[$i]->NOMBRE_CONTACTO_REFERENCIA//editar
                // 'G_REF_MON',//$reservas[$i]->TIPO_MONEDA
                // 'G_REF_IMP',//$reservas[$i]->IMPORTE_CHEQUES
                // 'G_AGE_COD',//$reservas[$i]->CODIGO_AGENCIA
                // 'G_AGE_SUC',//$reservas[$i]->CODIGO_SUCURSAL_AGENCIA
                // 'G_CON_TELF',//$reservas[$i]->destino_celular
                // 'G_UBI_DIST',//$reservas[$i]->distrito
                // 'G_UBI_PROV',//$reservas[$i]->provincia
                // 'G_UBI_DPTO',//$reservas[$i]->departamento
                // 'G_REF_EST',//$reservas[$i]->origen_referencia
                // 'G_REF_TIPO',//$reservas[$i]->SEGUNDO_origen_referencia
                // 'G_UBI_ORIG',//$reservas[$i]->origen_ubigeo//api
                // 'G_UBI_DEST',//$reservas[$i]->destino_ubigeo//api
                // 'G_TIP_TRAN',//$reservas[$i]->TIPO_TRANSPORTE//editar
                // 'G_RUTA',////VACIOOOOOOOOOOO
                // 'G_MASTER',//NUMERO_GUIA_MASTER
                // 'G_IND_MAST',//VACIOOOOOOOOOOO
                // 'PQT_ADIC',//$reservas[$i]->DATOS_ADICIONALES_ENVIO//editar
                // 'G_RANGO',//$reservas[$i]->HORARIO_COORDINACION_ENTREGA//editar
                // 'G_TPAGO',//$reservas[$i]->TIPO_PAGO//editar
                // 'G_PESO_VOL'//$reservas[$i]->peso_volumetrico
                // ];





                //
                // CODIGO_CIUDAD_ORIGEN
                // CODIGO_CIUDAD_DESTINO
                // DESTINO_PAIS
                // CODIGO_CIUDAD_DESTINO
                // ZONA
                // DISTRITO
                // PROVINCIA
                // DEPARTAMENTO
                // PESO_VOLUMETRICO









                array_push($data, $cabecera);

                $models = EnvioRegular::searchdownloaddata($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $reservas = $models->items();

                /*
                  $reservas = ReservaLocker::where('estado',1)
                  ->join('usuario', 'usuario.usuario_id', '=', 'reserva_lockers.usuario_id')
                  ->leftJoin('tarjeta', 'tarjeta.tarjeta_id', '=', 'reserva_lockers.tarjeta_id')
                  ->leftJoin('lockers', 'lockers.id', '=', 'reserva_lockers.locker_id')
                  ->select('reserva_lockers.*', 'usuario.usuario_nombre',
                  'usuario.usuario_apellidos', 'tarjeta.tarjeta_marca', 'lockers.nombre as locker_nombre')
                  ->orderBy('reserva_lockers.fecha_entrega', 'desc')
                  ->get();
                */

                for ($i = 0; $i < count($reservas); $i++) {
                    $origen_partes = explode(",",$reservas[$i]->origen_direccion_full);

                    isset($origen_partes[0])? $origen_departamento=$origen_partes[0] : '';
                    isset($origen_partes[1])? $origen_provincia=$origen_partes[1] : '';
                    isset($origen_partes[2])? $origen_distrito=$origen_partes[2] : '';
                    // $origen_departamento = $origen_partes[0];
                    // $origen_provincia = $origen_partes[1];
                    // $origen_distrito = $origen_partes[2];

                    //$tiempos = ['24','72','72+',''];//descomentar
                    //$tiempo_entrega = $tiempos[$reservas[$i]->tiempo];
                    switch ($reservas[$i]->tiempo) {
                      case '0':
                        $tiempo_entrega='24h';
                        break;
                      case '1':
                        $tiempo_entrega='72h';
                        break;
                      case '2':
                        $tiempo_entrega='72h+';
                        break;
                      default:
                        $tiempo_entrega='';
                        break;
                    }

                    $descuento_monto = $reservas[$i]->descuento_monto?$reservas[$i]->descuento_monto:0;

                    $comprobante = $reservas[$i]->emitir_factura?'RUC':'BOLETA';
                    $regular_ruc = $reservas[$i]->emitir_factura?$reservas[$i]->regular_ruc:'';
                    $regular_razonsocial = $reservas[$i]->emitir_factura?$reservas[$i]->regular_razonsocial:'';
                    $seguro = $reservas[$i]->seguro_envio_check?'Con seguro':'Sin seguro';

                    $tipousuario = $reservas[$i]->referencia_nombre?$reservas[$i]->referencia_nombre:"Directo";

                    $temp = array(
                        // $i + 1,
                        // $reservas[$i]->origen_calle,
                        // //$reservas[$i]->origen_ubigeo,
                        // $reservas[$i]->origen_direccion_full,
                        // $reservas[$i]->origen_interior,
                        // $reservas[$i]->origen_referencia,
                        // $reservas[$i]->origen_remitente,
                        // $reservas[$i]->origen_celular,
                        // $reservas[$i]->destino_calle,
                        // //$reservas[$i]->destino_ubigeo,
                        // $reservas[$i]->destino_direccion_full,
                        // $reservas[$i]->destino_interior,
                        // $reservas[$i]->destino_referencia,
                        // $reservas[$i]->destino_remitente,
                        // $reservas[$i]->destino_celular,
                        // $reservas[$i]->ancho,
                        // $reservas[$i]->altura,
                        // $reservas[$i]->profundidad,
                        // $reservas[$i]->peso,
                        // $reservas[$i]->tiempo,
                        // $reservas[$i]->costo_total,
                        // $reservas[$i]->cupon_descuento,
                        // $reservas[$i]->tarjeta_id,
                        // $reservas[$i]->usuario_id,




                        $reservas[$i]->id,//'ID de la transacción',
                        $reservas[$i]->created_at,//'Fecha de transacción',
                        $reservas[$i]->usuario_id,//'Id Cliente',
                        $tipousuario,//'Tipo de usuario',
                        $reservas[$i]->usuario_nombre,//'Nombres Cliente',
                        $reservas[$i]->usuario_apellidos,//'Apellidos Cliente',
                        $reservas[$i]->usuario_email,//'Correo cliente',
                        $reservas[$i]->usuario_dni,//'DNI cliente',
                        $comprobante,//'Comprobante de pago',
                        $regular_ruc,//'RUC',
                        $regular_razonsocial,//'Razón Social',
                        "",//'Tipo Origen', ADD: tipo_origen
                        "",//'Id Origen Punto Scharff', ADD: id_origen_punto_scharff
                        $reservas[$i]->origen_calle,//'Origen Calle (Dirección)',
                        $origen_departamento,//'Origen Departamento',
                        $origen_provincia,//'Origen Provincia',
                        $origen_distrito,//'Origen Distrito',
                        $reservas[$i]->origen_interior,//'Origen interior',
                        $reservas[$i]->origen_referencia,//'Origen observación',
                        $reservas[$i]->origen_remitente,//'Remitente Nombres y Apellido',
                        $reservas[$i]->origen_celular,//'Remitente Celular',
                        "Dirección",//'Tipo Origen || tipo destino', ADD: tipo_destino
                        "",//'Id Destino Punto Scharff', ADD: id_destino_punto_scharff
                        $reservas[$i]->destino_calle,//'Destino Calle (Dirección)',
                        $reservas[$i]->departamento,//'Destino Departamento',
                        $reservas[$i]->provincia,//'Destino Provincia',
                        $reservas[$i]->distrito,//'Destino Distrito',
                        $reservas[$i]->destino_interior,//'Destino interior',
                        $reservas[$i]->destino_referencia,//'Destino observación',
                        $reservas[$i]->destino_remitente,//'Destinatario Nombres y Apellido',
                        $reservas[$i]->destino_celular,//'Destinatario Celular',
                        $reservas[$i]->ancho,//'Ancho (cm)',
                        $reservas[$i]->altura,//'Altura (cm)',
                        $reservas[$i]->profundidad,//'Profundidad (cm)',
                        $reservas[$i]->peso,//'Peso (kg)',
                        "",//$reservas[$i]->valor_paquete'Valor paquete', ADD: valor_paquete
                        "Paquete",//$reservas[$i]->valor_paquete'Tipo paquete', ADD: valor_paquete
                        "1",
                        $reservas[$i]->peso_volumetrico,//'Peso volumétrico (KG)',
                        $tiempo_entrega,//'Tiempo de entrega',
                        $seguro,//$reservas[$i]->seguro_envio_check
                        $reservas[$i]->origen_ubigeo,//'Ubigeo Origen',
                        $reservas[$i]->destino_ubigeo,//'Ubigeo Destino',
                        (float)$reservas[$i]->costo_total+(float)$reservas[$i]->descuento_monto,//"",//'Tarifa cliente regular',
                        $reservas[$i]->fecha_recojo,//'Nombre de promoción',
                        $reservas[$i]->rango_entrega,//'Nombre de promoción',
                        $reservas[$i]->promocion_nombre,//'Nombre de promoción',
                        $descuento_monto,//'Descuento',
                        $reservas[$i]->costo_total,//'Tarifa cliente con descuento',
                        "Prepagado",//'Método de pago', ADD: metodo_pago
                        "Culqi",//'Medio de pago', ADD: medio_pago
                        $reservas[$i]->tarjeta_marca,//'Tarjeta',
                        $reservas[$i]->codigo_culqi_pago,//'Código Medio Pago',
                        $reservas[$i]->estado_medio_pago,//'Estado Medio de Pago',
                        $reservas[$i]->regular_contenido//'Estado Medio de Pago',




                        // tipo_origen
                        // id_origen_punto_scharff
                        // tipo_destino
                        // id_destino_punto_scharff
                        // valor_paquete
                        // seguro_envio_check
                        // metodo_pago
                        // medio_pago


                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }




    public function download_ubigeos(){
      $path = 'UBIGEOS LEADTIME_nov_21.csv';
      // if (!file_exists($path)) {
        return response()->download($path);
      // }else{
      //   return 'no-file';
      // }
    }

    public function upload_ubigeos(Request $request){
      $data = $request->all();
      $tfruta = 'elements/hojas_excel';
      $real;
      if ($request->hasFile('theFileInput')){
         $file = $request->file('theFileInput');


         // if (!file_exists($tfruta)) {
         //     mkdir($tfruta, 0777, true);
         //     chmod($tfruta, 0777);
         // }
         //$file->move($tfruta . '/', "UBIGEOS.csv");
         //$file = $request->file('theFileInput');
         $msj = 'El registro de ubigeos fue actualizado.';
         $estado = 0;

         $estan;

        if($file){
            $path = $tfruta . '/'. "UBIGEOS.csv";
            $path = $file->getRealPath();
            //return $path->__toString();
            $real = $path;

            $otro;
            $celdas = \Excel::load($path, function($reader) {
            })->get();
            if(!empty($celdas) && $celdas->count()){
                // foreach ($celdas as $key => $value) {
                //     $insert[] = ['title' => $value->title, 'description' => $value->description];
                // }
                // if(!empty($insert)){
                //
                // //  dd('Insert Record successfully.');
                // }


                $estan = UbigeosScharff::truncate();

                //DB::table('envio_regular')->insert($celdas);
                $arr = [];
                foreach ($celdas as $ar_i) {
                  $aux = [];
                  $aux['CODIGO_UBIGEO']= ($ar_i->codigo_ubigeo);
                  $aux['DEPARTAMENTO']= rtrim($ar_i->departamento,' ');
                  $aux['PROVINCIA']= rtrim($ar_i->provincia,' ');
                  $aux['DISTRITO']= rtrim($ar_i->distrito,' ');
                  $aux['CODIGO_CIUDAD']= ($ar_i->codigo_ciudad);
                  $aux['SERVICIO']= ($ar_i->servicio);
                  $aux['AEREO_PROPUESTO']= ($ar_i->aereo_propuesto);
                  $aux['TERRESTRE_PROPUESTO']= ($ar_i->terrestre_propuesto);
                  $json = json_encode(array(
                       "tiempos" => array(
                          "24" => $ar_i['tiempo_24'],
                          "72" => $ar_i['tiempo_72'],
                          "72+" => $ar_i['tiempo_72_mas']
                       ),
                  ));
                  $aux['OPCIONES']= $json;
                  $aux['OBSERVACION']= $ar_i->observacion;

                  $arr[]=$aux;
                }

                foreach ($arr as $arr_i) {
                  UbigeosScharff::create($arr_i);
                }


//http://localhost:8001/pickapp/api/v1/regular/tarifa?token=0c7cd9f31226aa9580c194c4d29ae112&ancho=1&altura=1&profundidad=1&peso=1&tiempo=1&destino_ubigeo=461&valor_paquete=&seguro_envio_check=false&destino_distrito=huanta&destino_provincia=huanta&destino_departamento=ayacucho
//http://localhost:8001/pickapp/api/v1/regular/tarifa?token=0c7cd9f31226aa9580c194c4d29ae112&ancho=1&altura=1&profundidad=1&peso=1&tiempo=0&destino_ubigeo=150102&valor_paquete=&seguro_envio_check=false&destino_distrito=ancon&destino_provincia=lima&destino_departamento=lima
//http://localhost:8001/pickapp/api/v1/regular/tarifa?token=0c7cd9f31226aa9580c194c4d29ae112&ancho=1&altura=1&profundidad=1&peso=1&tiempo=1&destino_ubigeo=461&valor_paquete=&seguro_envio_check=false&destino_distrito=huanta&destino_provincia=huanta&destino_departamento=ayacucho
                // $otro = (array)$celdas[1]->items;
                // UbigeosScharff::create($otro);
                // foreach ($celdas as $row) {
                //     UbigeosScharff::create($row);
                //   }
            }
        }


      }
      else{
        $msj = 'El registro de ubigeos no fue actualizado.';
        $estado = 1;
      }

      //$ubigeo = UbigeosScharff::findOrFail('2');

      return response()->json([
          'estado'=> $estado,
          'mensaje' => $msj,
          //  'real' => $msj,
          //  'celdas'=>$celdas,
          //  'estan'=>$estan,
          // 'otros'=>$arr,
          // 'sss'=>$ubigeo,

       ]);

    }
}
