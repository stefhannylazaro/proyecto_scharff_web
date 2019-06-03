<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $data = $request->all();
        $superadmin = Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'rol' => 'superadmin']);

        if ($superadmin)
        {
            return redirect()->route('adm.index');

        } else{

            $admin = Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'rol' => 'admin']);

            if ($admin){
                return redirect()->route('ad.index');
            } else {
                return Redirect::back()->withErrors(['Credenciales Incorrectas']);
            }
        }

        return Redirect::back();

    }

    public function login_vue(Request $request){

        $data = $request->all();

        $v = \Validator::make($data,[
            'user' => array(
                        'required',
                        'email',
                        'max:40',
                        'exists:users,email'
            ),
            'password' => 'required|min:3'
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
        //return $data['email'];
        /////////
        $usuarioApi=Usuario::findOrFail($data['userApi']);//
        $user = User::where('email', '=', $data['user'])->first();

        if (!Hash::check($usuarioApi->usuario_clave, $user->password)) {
            $pass = Hash::make($usuarioApi->usuario_clave);
            $user->password=$pass;
            $user->save();
        }
        ////////
        $admin = Auth::attempt(['email' => $data['user'], 'password' => $data['password']]);

        if ($admin){
            $data_respuesta['data'] = 'Sesión iniciada';
            $data_respuesta['status'] = 1;
            $data_respuesta['userdata'] = \Auth::user();


            //return response()->json($data_respuesta);
            //return redirect()->route('ad.index');
        }else{
          $data_respuesta['error'] = 'Correo electrónico o contraseña incorrecta';
          $data_respuesta['status'] = 0;
        }

        return response()->json($data_respuesta);

        $usuario = User::select('users.*')
            ->join('administrators', 'administrators.user_id', '=', 'users.id')
            ->where('email', $data['user'])
            ->first();

        if ($usuario) {
            if (\Hash::check($data['password'], $usuario->password)) {
                $data_respuesta['status'] = 1;
            } else {
                $data_respuesta['error'] = 'Correo electrónico o contraseña incorrecta';
            }
        } else {
            $data_respuesta['error'] = 'No existe este usuario.';
        }

        if ($data_respuesta['status'] == 1) {
            Auth::loginUsingId($usuario->id);

            $data_respuesta['data'] = array(
                'email' => $usuario->email,
                'rol' => $usuario->rol,
                'nombre' => $usuario->administrator->nombre
            );
        }

        return response()->json($data_respuesta);
    }






    protected function facebooklogin(Request $request){
      $data_respuesta = array(
          'status' => 0,
          'error' => '',
          'data' => []
      );



      $data = $request->all();

      //$admin = Auth::attempt(['email' => $data['email']]);

      $user = User::where('email', '=', $data['email'])->first();
      //echo $user->id;
      if($user){
        Auth::loginUsingId($user->id);
        $data_respuesta['data'] = $user;
        $data_respuesta['status'] = 1;
      }




      if (empty($user)) {


          $v = \Validator::make($data,[
              'usuario_nombre' => array(
                          'required',
                          'max:40'
              ),
              //'usuario_face_id' => 'unique:users',
              'email' => 'unique:users',
              'usuario_nombre' => 'required',
              'usuario_apellidos' => 'required',
          ]);

          if ($v->fails()) {
              $data_respuesta['error'] = $v->errors()->first();
              return response()->json( $data_respuesta );
          }

          //return response()->json( $data_respuesta );


          $usuario = User::create([
              'usuario_nombre' => $data['usuario_nombre'],
              'usuario_apellidos' => $data['usuario_apellidos'],
              'usuario_tipo' => 3,
              'email' => $data['email'],
              //'usuario_fbid' => $data['usuario_face_id'],
              'usuario_fbid' => $data['usuario_face_id'],
              'rol' => 'usuario',
              //'password' => bcrypt($data['password']),
          ]);


          if ($usuario) {
            $data_respuesta['status'] = 2;
            $data_respuesta['error'] = '';
            $data_respuesta['data'] = $usuario;
            
            Auth::loginUsingId($usuario->id);

          } else {
              $data_respuesta['error'] = 'Error registrando.';
          }



      }

      return response()->json( $data_respuesta );


    }






}
