<?php

namespace App\Http\Controllers\Admin;

use App\Models\Claimbook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClaimbookController extends Controller
{
    private $paginate = 10;

    private $directory = 'claimbook';

    public function index($column = null, $order = null)
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
        $models = Claimbook::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
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

    public function view($id){
        $obj = Claimbook::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('obj'));
    }

    public function download(){


        $request = request()->all();

        \Excel::create('LIBRO DE RECLAMACIONES', function ($excel) use ($request) {

            $excel->sheet('Sheetname', function ($sheet) use ($request)  {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:T1', 'thin');

                $sheet->cells('A1:T1', function ($cells) {
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

                $cabecera = [
                    'NRO. RECLAMO',
                    'FECHA CREACIÓN',
                    'LINEA DE SERVICIO',
                    'TIPO MONEDA',
                    'NOMBRE',
                    'DEPARTAMENTO',
                    'PROVINCIA',
                    'DISTRITO',
                    'DOMICILIO',
                    'DNI/CE',
                    'TELEFONO',
                    'CORREO',
                    'NOMBRE PADRES',
                    'BIEN CONTRATADO',
                    'MONTO RECLAMADO',
                    'DESCRIPCION',
                    'TIPO RECLAMO',
                    'DESCRIPCION',
                    'PEDIDO',
                    'OBSERVACIONES'
                ];

                array_push($data, $cabecera);


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


                $models = Claimbook::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);

                $reclamos = $models->items();

                for ($i = 0; $i < count($reclamos); $i++) {

                    $temp = array(
                        $reclamos[$i]->numero_reclamo,
                        $reclamos[$i]->created_at,
                        $reclamos[$i]->obtenerLineaServicio(),
                        $reclamos[$i]->tipo_moneda,
                        $reclamos[$i]->nombre,
                        $reclamos[$i]->ubigeo->departamento,
                        $reclamos[$i]->ubigeo->provincia,
                        $reclamos[$i]->ubigeo->distrito,
                        $reclamos[$i]->direccion,
                        $reclamos[$i]->documento,
                        $reclamos[$i]->telefono,
                        $reclamos[$i]->correo,
                        $reclamos[$i]->descripcion_menor_edad? $reclamos[$i]->descripcion_menor_edad:'-',
                        $reclamos[$i]->bien_contratado,
                        $reclamos[$i]->monto_reclamado,
                        $reclamos[$i]->descripcion_bien_contratado? $reclamos[$i]->descripcion_bien_contratado: '-',
                        $reclamos[$i]->tipo_reclamo,
                        $reclamos[$i]->detalle_reclamo,
                        $reclamos[$i]->pedido_reclamo? $reclamos[$i]->pedido_reclamo: '-',
                        $reclamos[$i]->observacion
                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }
}
