<?php

namespace App\Http\Controllers;

use App\Library\Funciones;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Runner\Exception;
use App\Models\Postulante;
use Mail;

class PostulantesController extends Controller
{
  private $paginate = 10;

  private $directory = 'postulante';

  public function admindex($column = null, $order = null)
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
      $models = Postulante::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
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
    $model = Postulante::find($id);
      //$obj = ReservaLocker::findOrFail($id);
      //print_r($obj);
      $tipos_scharfer_ar = $model->tipos_scharfer_ar();
      return view('admin.' . $this->directory . '.view', compact('model','tipos_scharfer_ar'));
  }




  public function edit($id){
      $model = Postulante::findOrFail($id);

      $tipos_scharfer_ar = $model->tipos_scharfer_ar();



      return view('admin.' . $this->directory . '.view', compact('model','tipos_scharfer_ar'));
  }

  public function admview_update(Request $request,$id){
      $data = $request->all();
      $model = Postulante::findOrFail($id);


      $model->fill($data);
      $model->save();

      return redirect()->route('adm.postulante.index')->with('mensaje','Postulante actualizado con éxito!!');
  }








    public function create(Request $request){


        $data = $request->all();

        //$data['fecha_entrega']=date('Y-m-d H:i');
        //$data['fecha_recojo']=date('Y/m/d H:i');

        //$datetime = new \DateTime('tomorrow');
        //$data['fecha_recojo'] =  $datetime->format('Y-m-d H:i:');


        //$mytime = Carbon::now();
        //$data['fecha_entrega'] = $mytime->toDateTimeString();

        $staff = '';
        $tipo_scharfer_label = '';

        if(isset($data['staff'])){
          $staff = $data['staff'];

        }


        if(isset($data['tipo_scharfer_label'])){
          $tipo_scharfer_label = $data['tipo_scharfer_label'];
        }

        unset($data['staff']);
        unset($data['tipo_scharfer_label']);


        $postulante =  Postulante::create($data);

        $data_respuesta =  [
            'status' => 0,
            'data' => 'Error al guardar',
        ];

        if($postulante){
          $data_respuesta =  [
              'status' => 1,
              'data' => 'Se guardo con exito',
          ];
        };


        $email = $data['correo'];



        Mail::send('email.postulante', [], function ($m) use ($email) {
            //$m->to('giancarlo.ramos@janaq.com', "Usuario")->subject('Gracias por postular en Scharff');
            $m->to($email, "Usuario")->subject('Gracias por postular en Scharff');
        });


        if(!empty($staff)){
          $postulante->tipo_scharfer_label = $tipo_scharfer_label;

          if (strpos($staff, ',') !== false) {
            $staff_email = explode(',', $staff);
          }else{
            $staff_email = $staff;
          }
          $data_respuesta['staff'] = $staff_email;

          $correoen = Mail::send('email.postulante_to_admin', ['obj' => $postulante], function ($m) use ($staff_email) {
              $m->to($staff_email, "Usuario")->subject('Un usuario a postulado para scharffer');
          });
        }else{
          $data_respuesta['staff_email'] = 'false';
        }

        return response()->json($data_respuesta);






    }





    public function download_data_system($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;
        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:H1', 'thin');

                $sheet->cells('A1:H1', function ($cells) {
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
                    'ITEM',
                    'NOMBRES',
                    'APELLIDOS',
                    'CORREO',
                    'CELULAR',
                    'FECHA_NACIMIENTO',
                    'TIPO_SCHARFFER',
                    'FECHA_SOLICITUD'
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




                $models = Postulante::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);

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


                $aux_tipoScharfferAr=array('Bicicleta','Moto','Auto');
                for ($i = 0; $i < count($reservas); $i++) {
                  try {
                      $tipo_aux = $aux_tipoScharfferAr[$reservas[$i]->tipo_scharfer-1];
                  } catch (Exception $e) {
                      $tipo_aux = '--';
                  }

                    $temp = array(
                        $reservas[$i]->id,
                        $reservas[$i]->nombre,
                        $reservas[$i]->apellidos,
                        $reservas[$i]->correo,
                        $reservas[$i]->celular,
                        $reservas[$i]->fecha_nacimiento,
                        $tipo_aux,
                        $reservas[$i]->created_at,

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

                $sheet->setBorder('A1:AC1', 'thin');

                $sheet->cells('A1:AC1', function ($cells) {
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
                    'Id Scharffer',
                    'Fecha de registro',
                    'Nombres',
                    'Apellidos',
                    'Dispositivos',
                    'DNI',
                    'Email',
                    'Celular',
                    'Fecha de nacimiento',
                    'Sexo',
                    'Dirección',
                    'Distrito Dirección',
                    'Estilo',
                    'Zonas',
                    'Placa',
                    'Banco',
                    'Número de cuenta',
                    'CCI',
                    'Ficha de datos',
                    'Validación datos',
                    'Motivo Rechazo',
                    'Nota evaluación',
                    'Términos & Condiciones',
                    'Estado',
                    'Capacidad',
                    'Calificación estrella',
                    'Clave',
                    'Mochila',
                    'POS'
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




                $models = Postulante::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $reservas = $models->items();



                $aux_tipoScharfferAr=array('Bicicleta','Moto','Auto');
                for ($i = 0; $i < count($reservas); $i++) {
                  try {
                      $tipo_aux = $aux_tipoScharfferAr[$reservas[$i]->tipo_scharfer-1];
                  } catch (Exception $e) {
                      $tipo_aux = '--';
                  }

                    $temp = array(
                        $reservas[$i]->id,//'Id Scharffer',
                        $reservas[$i]->created_at,//'Fecha de registro',
                        $reservas[$i]->nombre,//'Nombres',
                        $reservas[$i]->apellidos,//'Apellidos',
                        $reservas[$i]->dispositivo,//'Dispositivos',
                        $reservas[$i]->dni,//'DNI',
                        $reservas[$i]->correo,//'Email',
                        $reservas[$i]->celular,//'Celular'
                        $reservas[$i]->fecha_nacimiento,//'Fecha de nacimiento',
                        $reservas[$i]->sexo,//'Sexo',
                        $reservas[$i]->direccion,//'Dirección',
                        $reservas[$i]->distrito,//'Distrito Dirección',
                        $reservas[$i]->estilo,//'Estilo',
                        $reservas[$i]->zona,//'Zonas',
                        $reservas[$i]->placa,//'Placa',
                        $reservas[$i]->banco,//'Banco',
                        $reservas[$i]->numero_cuenta,//'Número de cuenta',
                        $reservas[$i]->cci,//'CCI',
                        $reservas[$i]->ficha_datos,//'Ficha de datos',
                        $reservas[$i]->validacion_datos,//'Validación datos',
                        $reservas[$i]->motivo_rechazo,//'Motivo Rechazo',
                        $reservas[$i]->nota_evaluacion,//'Nota evaluación',
                        $reservas[$i]->termino_condiciones,//'Términos & Condiciones',
                        $reservas[$i]->banco,//'Estado',
                        $reservas[$i]->capacidad,//'Capacidad',
                        $reservas[$i]->calificacion_estrella,//'Calificación estrella',
                        $reservas[$i]->clave,//'Clave',
                        $reservas[$i]->mochila,//'Mochila',
                        $reservas[$i]->pos//'POS'

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








}
