<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Models\Referencia;
use App\Models\ReferenciaUsuario;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'usuario_nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request){

      $data = $request->all();

      $v = \Validator::make($data,[
          'usuario_nombre' => array(
                      'required',
                      'max:40'
          ),
          'email' => 'unique:users|email',
          'password' => 'required|min:3',
      ]);

      $data_respuesta = array(
          'status' => 0,
          'error' => '',
          'data' => []
      );

      if ($v->fails()) {
          $data_respuesta['error'] = $v->errors()->first();
          return response()->json( $data_respuesta );
      }

      $usuario = User::create([
          'usuario_nombre' => $data['usuario_nombre'],
          'usuario_apellidos' => $data['usuario_apellidos'],
          // 'usuario_movil' => $data['usuario_movil'],
          'usuario_tipo' => $data['usuario_tipo'],
          // 'usuario_dni' => $data['usuario_dni'],
          'email' => $data['email'],
          'rol' => 'usuario',
          'password' => bcrypt($data['password']),
      ]);



      if ($usuario) {
        $data_respuesta['status'] = 1;
        $data_respuesta['error'] = '';
        $data_respuesta['data'] = 'register_success';


        $email = $data['email'];
        Mail::send('email.registro_ok', ['usuario_nombre' => $data['usuario_nombre']], function ($m) use ($email) {
            //$m->to('giancarlo.ramos@janaq.com', "Usuario")->subject('Gracias por registrarte en Scharff');
            $m->to($email, "Usuario")->subject('Gracias por registrarte en Scharff');
        });
        if(isset($data['referencia'])){
            $data_respuesta['referencia'] = $data['referencia'].$usuario->id;
            $this->procesaReferencia($data['referencia'],$usuario->id);
        }

        if(isset($data['usuario_usuario2'])){
          \DB::connection('pickapp_api')->table('usuario')
            ->where('usuario_id', $data['usuario_usuario2'])
            ->update(['usuario_webid' => $usuario->id]);
        }






      } else {
          $data_respuesta['error'] = 'Error registrando.';
      }




      return response()->json( $data_respuesta );

    }


    protected function resetear(Request $request){

      $data = $request->all();
      $email = $data['email'];

      $v = \Validator::make($data,[
          'email' => array(
                      'required',
                      'exists:users,email'
          )

      ]);

      $data_respuesta = array(
          'status' => 0,
          'error' => '',
          'data' => []
      );

      if ($v->fails()) {
          $data_respuesta['error'] = $v->errors()->first();
          return response()->json( $data_respuesta );
      }else{
        $laclave = str_random(8);
        $hashed_random_password = Hash::make(str_random(8));
        //$data_respuesta['data'] = $laclave;
        $data_respuesta['status'] = 1;
      }


      Mail::send('email.recuperar', ['clave' => $laclave], function ($m) use ($email) {
          $m->to('giancarlo.ramos@janaq.com', "juan")->subject('Clave cambiada!');
      });
      $request = Request::create('http://your-api.com', 'POST', ['param1' => 'value1', 'param2' => 'value2']);

      return response()->json( $data_respuesta );


    }



    public function resetearDirecto(Request $request ){


      $usuario_data = $request->all();
      $email = $usuario_data['usuario_email'];
      $clave = $usuario_data['usuario_clave'];
      $array_usuario = '';
      if(!empty($clave)){
        $hashed_random_password = Hash::make($clave);
        $array_usuario = User::where('email', $usuario_data["usuario_email"] )
            //->update(['usuario_clave' => $hashed_random_password]);
            ->update(['password' => $hashed_random_password]);


      }
      Mail::send('email.recuperar', ['clave' => $clave], function ($m) use ($email) {
          //$m->to('giancarlo.ramos@janaq.com', "juan")->subject('Clave reseteada');
          $m->to($email, "Usuario")->subject('Clave reseteada');
      });


      if (!$array_usuario) {
          return '0';
      }



      return '1';
    }



    public function resetearNoUsar(Request $request ){


      $usuario_data = $request->all();
      $email = $usuario_data['usuario_email'];
      $clave = $usuario_data['usuario_clave'];
      $array_usuario = '';
      if(!empty($clave)){
        $hashed_random_password = Hash::make($clave);
        $array_usuario = User::where('email', $usuario_data["usuario_email"] )
            //->update(['usuario_clave' => $hashed_random_password]);
            ->update(['password' => $hashed_random_password]);


      }

      if (!$array_usuario) {
          return '0';
      }



      return '1';
    }





    public function procesaReferencia($nombre,$user_id){
      $referencia = Referencia::where('nombre', '=', $nombre)->first();

      // if ($referencia === null) {
      //   $referencia = Referencia::create([
      //       'nombre' => $nombre
      //   ]);
      // }
      //
      // $ReferenciaUsuario_i = ReferenciaUsuario::create([
      //     'referencia_id' => $referencia->id,
      //     'usuario_id' => $user_id
      // ]);


      if ($referencia === null) {
        $ReferenciaUsuario_i = ReferenciaUsuario::create([
            'referencia_id' => null,
            'usuario_id' => $user_id
        ]);
      }else{

        $ReferenciaUsuario_i = ReferenciaUsuario::create([
            'referencia_id' => $referencia->id,
            'usuario_id' => $user_id
        ]);

      }







      return $ReferenciaUsuario_i;
    }




    public function usuario_actualizar_parciales(Request $request){
      echo "hola";
      return false;
      $data = $request->all();



      $data_respuesta = array(
          'status' => 0,
          'error' => '',
          'data' => []
      );





      $usuario = User::findOrFail($data['usuario_id']);
      print_r($usuario);
      return false;
      $usuario->fill($data);
      $usuario->save();



    }





}
