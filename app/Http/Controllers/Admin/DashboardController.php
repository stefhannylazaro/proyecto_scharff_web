<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Funciones;


class DashboardController extends Controller
{

    private $paginate = 10;

    public function index(){
        $reservas_sta = Funciones::estadisticasDashboard();
        $usuarios_ultimo_mes = Funciones::usuarios_mes_Dashboard();
        $postulaciones_ultimo_mes = Funciones::postulaciones_mes_Dashboard();
        $contactos_ultimo_mes = Funciones::contactos_mes_Dashboard();
        $postulantes = Funciones::postulantes_ultimos_Dashboard();

        //print_r($models->toArray());
        return view('admin.index', compact(
            'reservas_sta',
            'usuarios_ultimo_mes',
            'postulaciones_ultimo_mes',
            'contactos_ultimo_mes',
            'postulantes'
        ));
    }


    public function listado_general($column = null, $order = null)
    {
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
        $models = Funciones::searchGeneral($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
        $order = ($order == 'asc') ? 'desc' : 'asc';

        return view('admin.general', compact(
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




    public function download_listadogeneral($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:K1', 'thin');

                $sheet->cells('A1:K1', function ($cells) {
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


                $cabecera2 = [
                  'item',
                  'id de transacción',
                  'created_at',
                  'usuario_id',
                  'usuario_nombre',
                  'usuario_apellidos',
                  'email',
                  'usuario_dni',
                  'tarifa',
                  'tarjeta_id',
                  'tipo'
                ];






                array_push($data, $cabecera2);

                $reservas = Funciones::searchGeneral($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $reservas = $reservas->toArray();
                $c = 1;
                foreach ($reservas as $el) {

                  $temp = array(
                    $c,
                    " ".$el->id,
                    $el->created_at,
                    $el->usuario_id,
                    $el->usuario_nombre,
                    $el->usuario_apellidos,
                    $el->email,
                    $el->usuario_dni,
                    $el->tarifa,
                    $el->tarjeta_id,
                    $el->tipo,
                  );
                  array_push($data, $temp);
                  $c++;
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

                $sheet->setBorder('A1:U1', 'thin');

                $sheet->cells('A1:U1', function ($cells) {
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

                $pager = 3000;
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
                  'ID transacción',
                  'Fecha de transacción',
                  'ID cliente',
                  'Tipo de usuario',
                  'Servicio',
                  'Nombres Cliente',
                  'Apellidos Cliente',
                  'Correo Cliente',
                  'Número de documento',
                  'RUC',
                  'Razón Social',
                  'Comprobante',
                  'Cantidad',
                  'Tarifa cliente regular',
                  'Nombre de promoción',
                  'Descuento',
                  'Tarifa cliente con descuento',
                  'Medio de pago',
                  'Tarjeta',
                  'Código Medio Pago',
                  'Estado Medio de Pago'
                ];

                array_push($data, $cabecera);

                $reservas = Funciones::searchData($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $reservas = $reservas->toArray();
                $c = 1;
                foreach ($reservas as $el) {

                  if($el->emitir_factura) {
                    $comprobante= "Factura";
                    $ruc=$el->usuario_ruc;
                    $razon_social=$el->usuario_razonsocial;
                  } else {
                    $comprobante= "Boleta";
                    $ruc='';
                    $razon_social='';
                  }
                  $temp = array(
                    $el->id,// 'ID transacción'
                    $el->created_at,// 'Fecha de transacción'
                    $el->usuario_id,// 'ID cliente'
                    '',// 'Tipo de usuario'**cambiar
                    $el->tipo,// 'Servicio'
                    $el->usuario_nombre,// 'Nombres Cliente'
                    $el->usuario_apellidos,// 'Apellidos Cliente'
                    $el->email,// 'Correo Cliente'
                    $el->usuario_dni,// 'Número de documento'

                    $ruc,// 'RUC' (solo si es factura)
                    $razon_social,// 'Razón Social' (solo si es factura)
                    $comprobante,// 'Comprobante' (solo si es factura)

                    '1',// 'Cantidad'
                    (float)$el->tarifa + (float)$el->descuento_monto,// 'Tarifa cliente regular'?
                    $el->promocion_nombre,// 'Nombre de promoción'
                    $el->descuento_monto,// 'Descuento'
                    $el->tarifa,// 'Tarifa cliente con descuento' el monto que pago?
                    '',// 'Medio de pago'
                    $el->tarjeta_marca,// 'Tarjeta nombre'
                    $el->codigo_mediopago,// 'Código Medio Pago'
                    $el->estado_mediopago// 'Estado Medio de Pago'

                  );
                  array_push($data, $temp);
                  $c++;
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }
}
