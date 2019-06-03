<?php

namespace App\Http\Controllers\Service;

use App\Models\LogTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LogTransactionController extends Controller
{
    private $directory = 'log';
    private $paginate = 10;


    public function create(Request $request){


        $data = $request->all();


        $reservaLocker =  LogTransaction::create($data);

        //$reservaLocker['fecha_entrega']=date('Y-m-d H:i:s');
        //$reservaLocker['fecha_recojo']=date('Y/m/d H:i');
        $data_respuesta =  [
            'status' => 0,
            'data' => 'Error al registrar',
        ];

        if($reservaLocker){
          $data_respuesta =  [
              'status' => 1,
              'data' => 'Log guardado con exito',
          ];
        };

        return response()->json($data_respuesta);


    }




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
      $models = LogTransaction::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
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
      $model = LogTransaction::find($id);
        //$obj = ReservaLocker::findOrFail($id);
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

                $sheet->setBorder('A1:E1', 'thin');

                $sheet->cells('A1:E1', function ($cells) {
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
                  'ID',
                  'CUSTOMER ID',
                  'TIPO ACCION',
                  'TRAMA RESPUESTA CULQI',
                  'FECHA REGISTRO',

                ];


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










                array_push($data, $cabecera);
                $models = LogTransaction::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $reservas = $models->items();

                for ($i = 0; $i < count($reservas); $i++) {
                    $temp = array(
                        $reservas[$i]->id,
                        $reservas[$i]->customer_id,
                        $reservas[$i]->tipo_accion,
                        $reservas[$i]->trama_respuesta_culqi,
                        $reservas[$i]->created_at
                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }

}
