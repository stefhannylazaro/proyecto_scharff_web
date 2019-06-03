<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Usuario;
use App\Models\ReferenciaUsuario;
use App\Models\Referencia;
use App\Models\Tarjeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $paginate = 10;

    private $directory = 'user';

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
        $models = User::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin, 'todos');
        //print_r($models->toArray());
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




    public function index_b($column = null, $order = null)
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
        $models = User::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin, 'api');
        //print_r($models->toArray());
        $order = ($order == 'asc') ? 'desc' : 'asc';

        $casodb = 'api';
        return view('admin.' . $this->directory . '.index', compact(
            'models',
            'pager',
            'search',
            'column',
            'order',
            'request',
            'fecha_inicio',
            'fecha_fin',
            'casodb'
        ));
    }

    public function view($id){
        $model = Usuario::findOrFail($id);

        $user_id = $model->usuario_webid;

        $referenciaUsuario = ReferenciaUsuario::select('referencia_id')->where('usuario_id', '=', $user_id)->first();
        $tipos_ar = $this->tiposLista();



        // $referenciaUsuario = ReferenciaUsuario::select('referencia_id','nombre')->leftJoin('referencia', 'referencia_usuario.referencia_id', '=', 'referencia.id')
        //     ->where('referencia_usuario.usuario_id', '=', $user_id)->first();

        //$modelapi = Usuario::find($id);
        $referenciaUsuario_id = '';
        if($referenciaUsuario){
            $referenciaUsuario_id = (float)$referenciaUsuario->referencia_id;
        }
        //print_r($modelapi);

        //if($modelapi){
          // $model[]
        //}
        $model['password'] = '';
        // print_r($modelapi);
        // echo "====================";
        //print_r($model);
        //print_r($referenciaUsuario_id);
        return view('admin.' . $this->directory . '.view', compact('model','referenciaUsuario_id','tipos_ar'));
    }


    public function view_b($id){
        $model = Usuario::findOrFail($id);

        $user_id = $model->usuario_id;

        $referenciaUsuario_id = null;
        $model->email = $model->usuario_email;
        $tipos_ar = [];
        $casodb = 'api';
        return view('admin.' . $this->directory . '.view', compact('model','referenciaUsuario_id','tipos_ar','casodb'));
    }




    public function edit($id){
        $model = Usuario::findOrFail($id);
        return view('admin.' . $this->directory . '.view', compact('model'));
    }




    public function view_update(Request $request,$id){
        $data = $request->all();
        $modelapi = Usuario::findOrFail($id);
        $modelweb = User::where('email','=',$modelapi->usuario_email)->first();
        //$modelapi = Usuario::findOrFail($id);

        $pass = $data['password'];
        $passb = $data['passwordb'];


        if($modelapi){

          $datapi = [];

          $datapi['usuario_nombre'] = $data['usuario_nombre'];
          $datapi['usuario_movil'] = $data['usuario_movil'];
          $datapi['usuario_email'] = $data['usuario_email'];
          //$datapi['usuario_clave'] c v $data['password'];
          //$datapi['usuario_tipo'] = $data['usuario_tipo'];
          $datapi['usuario_apellidos'] = $data['usuario_apellidos'];
          $datapi['usuario_dni'] = $data['usuario_dni'];




          if(!empty($pass)&&$pass==$passb){
            $datapi['usuario_clave'] = $pass;
          }
          $modelapi->fill($datapi);
          $modelapi->save();




          $referenciaUsuario_id = $data['referenciaUsuario_id'];
          print_r($referenciaUsuario_id);
          if(!empty($referenciaUsuario_id)){
            $referencia = ReferenciaUsuario::updateOrCreate(
                ['usuario_id' => $modelweb->id], ['referencia_id' => $referenciaUsuario_id]
            );
          }else{
            $referencia = ReferenciaUsuario::updateOrCreate(
                ['usuario_id' => $modelweb->id], ['referencia_id' => NULL]
            );
            // User::where('votes', '>', 100)->delete();
          }

        };

        if(!empty($pass)&&$pass==$passb){
          $passHashed = Hash::make($pass);
          $data['password'] = $passHashed;
        }else {
          unset($data['password']);
        }




        $modelweb->fill($data);



        $modelweb->save();
        // print_r($data);
        // return 1;
        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Usuario actualizado con éxito!!');
    }


    public function view_update_b(Request $request,$id){
      $modelapi = Usuario::findOrFail($id);
      $data = $request->all();

      $datapi = [];

      $datapi['usuario_nombre'] = $data['usuario_nombre'];
      $datapi['usuario_movil'] = $data['usuario_movil'];
      $datapi['usuario_email'] = $data['email'];
      //$datapi['usuario_clave'] c v $data['password'];
      //$datapi['usuario_tipo'] = $data['usuario_tipo'];
      $datapi['usuario_apellidos'] = $data['usuario_apellidos'];
      $datapi['usuario_dni'] = $data['usuario_dni'];




      if(!empty($pass)&&$pass==$passb){
        $datapi['usuario_clave'] = $pass;
      }
      $modelapi->fill($datapi);
      $modelapi->save();

      return redirect()->route('adm.' . $this->directory . '.index_b')->with('mensaje','Usuario actualizado con éxito!!');
    }

    public function create(){
        return view('admin.' . $this->directory . '.create');
    }

    public function save(Request $request){

        $data = $request->all();
        $model = Usuario::create($data);

        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Usuario creado con éxito!!');;
    }





    public function download($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;


        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:I1', 'thin');

                $sheet->cells('A1:I1', function ($cells) {
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
                  'id',
                  'email',
                  'usuario_nombre',
                  'usuario_apellidos',
                  'usuario_movil',
                  'tipo(de registro)',
                  'usuario_dni',
                  'tipo(corporativo)',
                  'fecha de registro'

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



                $models = Usuario::search($pager, $search, $request['column'], $request['order'], $fecha_inicio, $fecha_fin, 'todos');
                $reservas = $models->items();





                for ($i = 0; $i < count($reservas); $i++) {
                    $temp = array(

                      $reservas[$i]->usuario_id,
                       $reservas[$i]->usuario_email,
                       $reservas[$i]->usuario_nombre,
                       $reservas[$i]->usuario_apellidos,
                       $reservas[$i]->usuario_movil,
                       $reservas[$i]->nombre_referencia?$reservas[$i]->nombre_referencia:'directo',//'Tipo de usuario'
                       $reservas[$i]->usuario_dni,
                       $reservas[$i]->usuario_escorporativo==1?"Si":"No",
                       $reservas[$i]->usuario_fecharegistro,


                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }


    public function tiposLista(){
        $tipos = Referencia::select('id','nombre')->orderBy('nombre','desc')->get()->toArray();
        $tipos_ar = array();
        $tipos_ar[''] = 'Ninguno';
        for ($i = 0; $i < count($tipos); $i++){
           $tipos_ar[(float)$tipos[$i]['id']] = $tipos[$i]['nombre'];
        }
        return $tipos_ar;
    }


    public function download_data($column = null, $order = null){
        $request = request()->all();
        $request['column'] = $column;
        $request['order'] = $order;


        \Excel::create('DATA', function ($excel) use ($request){

            $excel->sheet('DATA', function ($sheet) use ($request) {

                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:Q1', 'thin');

                $sheet->cells('A1:Q1', function ($cells) {
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
                  'Fecha Registro',
                  'Id Cliente',
                  'Tipo de usuario',
                  'Nombres',
                  'Apellidos',
                  'Correo',
                  'Teléfono',
                  'Celular',
                  'DNI',
                  'Fecha de nacimiento',
                  'Sexo',
                  'Dirección',
                  'Distrito',
                  'Tarjetas asociadas',
                  'RUC',
                  'Razón Social',
                  'Es corporativo'
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

                $models = Usuario::search($pager, $search, $request['column'], $request['order'], $fecha_inicio, $fecha_fin, 'todos');
                $reservas = $models->items();

                for ($i = 0; $i < count($reservas); $i++) {
                    //$tarjetas = Tarjeta::select('tarjeta_numero')->where('usuario_id', '=', $reservas[$i]->usuario_id)->get()->toArray();
                    $tarjetas = [];
                    $listado_tarjetas = '';
                    for ($j = 0; $j < count($tarjetas); $j++){
                       $listado_tarjetas = $listado_tarjetas.''.$tarjetas[$j]['tarjeta_numero']."-\n";
                    }
                    // print_r($listado_tarjetas);
                    // die();

                    $temp = array(
                        $reservas[$i]->usuario_fecharegistro,//'Fecha Registro',
                        $reservas[$i]->usuario_id,//'Id Cliente'
                        $reservas[$i]->nombre_referencia?$reservas[$i]->nombre_referencia:'directo',//'Tipo de usuario'
                        $reservas[$i]->usuario_nombre,//'Nombres'
                        $reservas[$i]->usuario_apellidos,//'Apellidos'
                        $reservas[$i]->usuario_email,//'Correo'
                        $reservas[$i]->usuario_telefono,//'Teléfono'
                        $reservas[$i]->usuario_movil,//'Celular'
                        $reservas[$i]->usuario_dni,//'DNI'
                        '',//'Fecha de nacimiento'
                        $reservas[$i]->usuario_genero,//'Sexo'
                        '',//'Dirección'
                        '',//'Distrito'
                        $listado_tarjetas,//'Tarjetas asociadas'
                        $reservas[$i]->usuario_ruc,//'RUC'
                        $reservas[$i]->usuario_razonsocial,//'Razón Social'
                        $reservas[$i]->usuario_escorporativo==1?"Si":"No",

                    );


                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }



}
