<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Mail;
use Artisan;


class AdminController extends Controller
{
    private $paginate = 10;

    private $directory = 'admin';

    public function home(){

      return "hola mundo";
        //return view('admin.index');
    }



    public function getUserInfo(){
      if(\Auth::check()){
        return \Auth::user();
      }else{
        return [
          'status'=>1,
          'logged'=>0
        ];
      }
    }


    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = Administrator::search($pager, $search, $column, $order);
        $order = ($order == 'asc') ? 'desc' : 'asc';
        return view('admin.' . $this->directory . '.index', compact(
            'models',
            'pager',
            'search',
            'column',
            'order',
            'request'
        ));
    }



    public function create(){
        $perfil = ['' => 'Selecione Perfil'];
        $perfil += Perfil::pluck('nombre', 'id')->toArray();

        return view('admin.' . $this->directory . '.create', compact('perfil'));
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'celular' => 'required|digits:9',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('rol', 'superadmin');
                })
            ],
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'password' => 'required|confirmed|min:6',
            'perfil' => 'required|exists:perfil,id,estado,1'
        ]);


        $user = new User();
        $user->usuario_nombre = $data['nombre'];
        $user->usuario_apellidos = $data['apellido'];
        $user->usuario_movil = $data['celular'];
        $user->email = $data['email'];
        $user->rol = 'superadmin';
        $user->password = bcrypt($data['password']);
        $user->save();

        $admin = new Administrator();
        $admin->user_id = $user->id;
        $admin->perfil_id = $data['perfil'];
        $admin->save();

        return redirect()->route('adm.admin.index')->with('mensaje','Administrador creado con éxito!!');;
    }


    public function edit($id){
        $perfil = ['' => 'Selecione Perfil'];
        $perfil += Perfil::pluck('nombre', 'id')->toArray();

        $model = Administrator::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('model', 'perfil'));
    }


    public function update(Request $request, $id){
        $perfil = ['' => 'Selecione Perfil'];
        $perfil += Perfil::pluck('nombre', 'id')->toArray();

        $model = Administrator::findOrFail($id);

        $this->validate($request, [
            'celular' => 'required|digits:9',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($model->user->id, 'id')->where(function ($query)  {
                    return $query->where('rol', 'superadmin');
                }),
            ],
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'password' => '',
            'password_confirmation' => 'required_with:password',
            'perfil' => 'exists:perfil,id,estado,1'
        ]);

        $data = $request->all();
        $model->user->usuario_nombre = $data['nombre'];
        $model->user->usuario_apellidos = $data['apellido'];
        $model->user->usuario_movil = $data['celular'];
        $model->user->email = $data['email'];
        $model->user->rol = 'superadmin';

        if ($data['password']){
            $model->user->password = bcrypt($data['password']);
        }

        $model->user->save();

        $model->perfil_id = $data['perfil'];
        $model->save();

        return redirect()->route('adm.admin.index')->with('mensaje','Administrador actualizado con éxito!!');;
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function cambiar_datos(Request $request){
      if(\Auth::check()){
        $this_email = \Auth::user()->email;
      }else{
        return [
          'status'=>1,
          'logged'=>0
        ];
      }





      $usuario_data = $request->all();

      $v = \Validator::make($usuario_data,[
          'usuario_email' => 'email',
          'usuario_nombre'=>'required',
          'usuario_apellidos'=>'required',
          'usuario_email'=>'required',
          'usuario_id'=>'required',
          'usuario_id2'=>'required',
          'usuario_nombre'=>'required',

          'cambiar_clave'=>'required',
      ]);


      $cambiar_clave = $usuario_data['cambiar_clave'];

      $usuario_apellidos = $usuario_data['usuario_apellidos'];
      $usuario_clave = $usuario_data['usuario_clave'];
      $usuario_dni = $usuario_data['usuario_dni'];
      $usuario_email = $usuario_data['usuario_email'];
      $usuario_id = $usuario_data['usuario_id'];
      $usuario_id2 = $usuario_data['usuario_id2'];
      $usuario_movil = $usuario_data['usuario_movil'];
      $usuario_nombre = $usuario_data['usuario_nombre'];
      $usuario_razonsocial = $usuario_data['usuario_razonsocial'];
      $usuario_ruc = $usuario_data['usuario_ruc'];


      if($cambiar_clave==1){
          $usuario_update2 = \DB::connection('pickapp_api')
          ->table('usuario')
          ->where('usuario_id', '=', $usuario_id2)
          ->update([
            'usuario_apellidos' => $usuario_apellidos,
            'usuario_dni' => $usuario_dni,
            'usuario_email' => $usuario_email,
            'usuario_movil' => $usuario_movil,
            'usuario_nombre' => $usuario_nombre,
            'usuario_razonsocial' => $usuario_razonsocial,
            'usuario_ruc' => $usuario_ruc,
            'usuario_clave' => $usuario_clave,
          ]);

          $hashed_random_password = Hash::make($usuario_clave);

          $usuario_update = \DB::table('users')
          ->where('id', '=', $usuario_id)
          ->update([
            'password' => $hashed_random_password,
            'email' => $usuario_email,
            'usuario_nombre' => $usuario_nombre,
            'usuario_apellidos' => $usuario_apellidos,
            'usuario_dni' => $usuario_dni,
          ]);

      }else{
        $usuario_update2 = \DB::connection('pickapp_api')
        ->table('usuario')
        ->where('usuario_id', '=', $usuario_id2)
        ->update([
          'usuario_apellidos' => $usuario_apellidos,
          'usuario_dni' => $usuario_dni,
          'usuario_email' => $usuario_email,
          'usuario_movil' => $usuario_movil,
          'usuario_nombre' => $usuario_nombre,
          'usuario_razonsocial' => $usuario_razonsocial,
          'usuario_ruc' => $usuario_ruc
        ]);

        $usuario_update = \DB::table('users')
        ->where('id', '=', $usuario_id)
        ->update([
          'email' => $usuario_email,
          'usuario_nombre' => $usuario_nombre,
          'usuario_apellidos' => $usuario_apellidos,
          'usuario_dni' => $usuario_dni,
        ]);

      }


      $data_respuesta = array(
          'status' => 0,
          'error' => '',
          'data' => []
      );
      $data_respuesta['aa'] = $usuario_update;
      $data_respuesta['bb'] = $usuario_update2;

      if ($v->fails()) {
          $data_respuesta['error'] = $v->errors()->first();
          return response()->json( $data_respuesta );
      }



      $email_nuevo = $usuario_email;


      if ($usuario_update2) {
        $data_respuesta['status'] = 1;
        $data_respuesta['error'] = '';

        $data_respuesta['data'] = 'cambio_datos';

        $email = $usuario_email;
        if(isset($hashed_random_password)){//cambio de clave
          $data_respuesta['data'] = 'cambio_exitoso_clave';

          Mail::send('email.cambio_clave', ['usuario_nombre' => $usuario_nombre,'cambio_otros_datos' => 0,'email_nuevo' => $email_nuevo], function ($m) use ($email) {
              $m->to($email, "Usuario")->subject('Has cambiado tu clave de Scharff');
              //$m->to('giancarlo.ramos@janaq.com', "Usuario")->subject('Has cambiado tu clave de Scharff');
              //$m->to($email, "Usuario")->subject('Gracias por registrarte en Scharff');
          });

        }else if(!empty($email_nuevo)){
          Mail::send('email.cambio_clave', ['usuario_nombre' => $usuario_nombre,'cambio_otros_datos' => 1,'email_nuevo' => $email_nuevo], function ($m) use ($email) {
              //$m->to('giancarlo.ramos@janaq.com', "Usuario")->subject('Has cambiado tu clave de Scharff');
              $m->to($email, "Usuario")->subject('Has modificado tus datos');
              //$m->to($email, "Usuario")->subject('Gracias por registrarte en Scharff');
          });
        }

      } else {
          $data_respuesta['error'] = 'Error cambiando los datos.';
      }
      return response()->json( $data_respuesta );

    }






    public function download($column = null, $order = null){
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
                  'id',
                  'email',
                  'usuario_nombre',
                  'usuario_apellido',
                  'usuario_movil',
                  // 'usuario_tipo',
                  // 'usuario_dni',

                ];

                array_push($data, $cabecera);

                $models = User::search($pager, $search, $request['column'], $request['order']);
                $reservas = $models->items();

                for ($i = 0; $i < count($reservas); $i++) {
                    $temp = array(
                      $reservas[$i]->id,
                      $reservas[$i]->email,
                      $reservas[$i]->usuario_nombre,
                      $reservas[$i]->usuario_apellidos,
                      $reservas[$i]->usuario_movil,
                      //$reservas[$i]->usuario_tipo,
                      //$reservas[$i]->usuario_dni,
                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }




    public function elseeder(Request $request){
    //Artisan::call('db:seed --class=UbigeosScharffSeeder');
    //php artisan
      $req = $request->all();
      if(isset($req['cual'])){
        $cual = $req['cual'];
        Artisan::call('db:seed', ['--class' => $cual]);
        echo "seeded";
      }else{
        echo "no seed";
      }

    }

    public function elmigration(Request $request){
    //Artisan::call('db:seed --class=UbigeosScharffSeeder');
    //php artisan
    Artisan::call('migrate');

      echo "migrated";
    }


    public function function_exists(Request $request){
    //Artisan::call('db:seed --class=UbigeosScharffSeeder');
    //php artisan

      $req = $request->all();
      if(isset($req['cual'])){
        $respuesta = "falso";
        if(function_exists($req)){
            $respuesta = "true";
        }
        echo $respuesta;
      }else{
        echo "error";
      }

    }





    public function updateuserides(Request $request){
    //Artisan::call('db:seed --class=UbigeosScharffSeeder');
    //php artisan


      $users = \DB::table('users')->select('users.id','users.email')->get()->toArray();
      //print_r($users);

      foreach($users as $user){
        \DB::connection('pickapp_api')->table('usuario')
          ->where('usuario_email', $user->email)
          ->update(['usuario_webid' => $user->id]);
      }
      return "hola";

    }

    // public function auxrfacebook(Request $request){
    // //Artisan::call('db:seed --class=UbigeosScharffSeeder');
    // //php artisan
    //
    //
    //   $users = \DB::table('users')->select('users.id','users.email')->get()->toArray();
    //   //print_r($users);
    //
    //   \DB::connection('pickapp_api')->table('usuario')
    //     ->where('usuario_email', "dexter00x@gmail.com")
    //     ->update(['usuario_fbid' => NULL]);
    //   return "face";
    //
    // }
    //
    //




}
