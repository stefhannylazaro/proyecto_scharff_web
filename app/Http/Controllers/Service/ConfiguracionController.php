<?php

namespace App\Http\Controllers\Service;

use App\Models\Banner;
use App\Models\User;
use App\Models\ConfiguradorLink;
use App\Models\ConfiguradorTexto;
use App\Models\Servicio;
use App\Models\Opciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MotivoContacto;
use App\Models\Sucursal;

class ConfiguracionController extends Controller
{

  static function getMetas(){
      return [
        "home" => [
          "titulo" => "Scharff: Envía. Recibe. Acerca. | Más de 30 años diseñando logística.",
          "keywords" =>"envios peru, peru envios, courier peru, envios a peru, peru envio, envio peru, fedex peru,courier internacional peru,
  logistica peru, logistica, transporte logistica, transporte logistico, servicios logistica, operador logistica, operador logistico, logistica empresa,  mensajeria lima, mensajeria peru, mensajeria metropolitana, courier metropolitano, envio de paquetes, paqueteria, locker, express, glovo, uber",
          //"descripcion" => "En Scharff creamos conexiones de alto valor para nuestros clientes a través de soluciones estratégicas diseñadas en nuestro Scharff Lab, el primer laboratorio de innovación logística en el Perú. A partir de nuestra experiencia. Carga. Aduana. Transporte. Almacenamiento. Distribución. FedEx Express. ¡Vive la experiencia!",
          "descripcion" => "Ofrecemos experiencias y servicios de logística a nivel nacional e internacional para grandes empresas y para ti. Únete a nuestra red y llega más lejos.",
        ],
        "scharff-stop" => [
          "titulo" => "Scharff: Envíos Vía Lockers | Más de 30 años diseñando logística.",
          "keywords" =>"",
          "descripcion"=>"¡Envía, Recibe y Acerca de la manera más práctica y sencilla! Contamos con tres diferentes tamaños para tus paquetes."
        ],
        "complaints-book" => [
          "titulo" => "Libro de reclamaciones | Scharff",
          "descripcion"=>""
        ],
        "scharff-express" => [
          "titulo" => "Scharff: Envíos Express | Más de 30 años diseñando logística.",
          "descripcion"=>"¡Moviliza tus productos con nuestra red de delivery express! Pide un Scharffer desde nuestra web."
        ],
        "scharff-club" => [
          "titulo" => "Scharff Club | Scharff",
          "descripcion"=>""
        ],
        "domestica" => [
          "titulo" => "Scharff: Servicio de Carga Nacional | Más de 30 años diseñando logística.",
          "descripcion"=>"¡Transportamos todo tipo de carga! Accede a nuestra red de transportistas a nivel nacional."
        ],
        "aduanas" => [
          "titulo" => "Scharff: Servicio de Aduanas | Más de 30 años diseñando logística.",
          "descripcion"=>"¡Gestión y Asesoría Personalizada de Comercio Exterior! Estamos en todas las jurisdicciones de Perú y Bolivia."
        ],
        "almacenes" => [
          "titulo" => "Scharff: Almacén | Más de 30 años diseñando logística.",
          "descripcion"=>"¡Contamos con el espacio que tu negocio necesita para crecer! "
        ],
        "carga" => [
          "titulo" => "Scharff: Servicio de Carga Internacional | Más de 30 años diseñando logística.",
          "descripcion"=>"¡Que tu negocio cruce fronteras! Transportamos tus productos vía aérea, marítima y terrestre."
        ],
        "distribucion" => [
          "titulo" => "Scharff: Servicio de Distribución | Más de 30 años diseñando logística.",
          "descripcion"=>"¡Accede a nuestra red urbana y nacional de distribución! Cuentas con trazabilidad para el seguimiento de tus envíos."
        ],
        "empresa" => [
          "titulo" => "Scharff Empresa | Scharff",
          "descripcion"=>""
        ],
        "para-ti" => [
          "titulo" => "Scharff Para ti | Scharff",
          "descripcion"=>""
        ],
        "lab" => [
          "titulo" => "Scharff: ScharffLab | Más de 30 años diseñando logística.",
          "descripcion"=>"¡Creamos el primer laboratorio de innovación logística en el Perú! Usamos metodologías ágiles y de design thinking para diseñar soluciones específicas para tu empresa."
        ],
        "unirse-scharffer" => [
          "titulo" => "Unete | Scharff",
          "descripcion"=>""
        ],
        "terminos-y-condiciones" => [
          "titulo" => "Terminos y condiciones | Scharff",
          "descripcion"=>""
        ],
        "preguntas-frecuentes" => [
          "titulo" => "Preguntas Frecuentes | Scharff",
          "descripcion"=>""
        ],
        "registro" => [
          "titulo" => "Registro | Scharff",
          "descripcion"=>""
        ],
      ];
  }




    public function home_config(){
        $links = ConfiguradorLink::where('vista', "'HOME'")
            ->select('clave','link')
            ->get()
            ->toArray();
        $textos = ConfiguradorTexto::where('vista', 'HOME')
            ->select('clave', 'titulo', 'descripcion')
            ->get()
            ->toArray();
        $servicios = Servicio::where('estado', 1)
            ->select('titulo', 'imagen')
            ->orderBy('orden', 'ASC')
            ->get()
            ->toArray();
        $banners = Banner::where('estado', 1)
            ->select('titulo', 'subtitulo', 'imagen', 'slug','atributos','url','order')
            ->orderBy('slug')
            ->orderBy('order', 'ASC')
            ->get()
            ->toArray();
        $opciones = Opciones::select('slug', 'valor')
            ->get()
            ->toArray();

        $motivos = MotivoContacto::latest()->orderBy('orden', 'ASC')->get()->toArray();

        $sucursales = Sucursal::latest()->get()->toArray();


        $data_respuesta = [
            'banner' => $banners,
            'links' => $links,
            'textos' => $textos,
            'servicios' => $servicios,
            'opciones' => $opciones,
            'metas' => self::getMetas(),
            'motivos' => $motivos,
            'sucursales' => $sucursales,
        ];

        return response()->json($data_respuesta);

    }


    public function getTerminos(){
      try {
        $textos = \DB::table('configurador_textos')->where('vista', 'terminos')
            ->select('clave', 'titulo', 'descripcion')
            ->get()
            ->toArray();
      } catch (\Exception $e) {
        echo ($e->getMessage());
        return "";
      }


        return response()->json($textos);
    }

    public function getTerminosb(){
      try {
        echo "que pasa";
      } catch (\Exception $e) {
        echo ($e->getMessage());

      }
return "aaa";
    }



    public function banner_config($lug){
        $banners = Banner::where('estado', 1)
            ->where('slug', $lug)
            ->select('titulo', 'subtitulo', 'imagen')
            ->get()
            ->toArray();
        return response()->json($banners);
    }


    public function admin_config(Request $request){
        // $promociones = Promocion::select('titulo', 'subtitulo', 'imagen')
        //     ->get()
        //     ->toArray();
        //
        //
        // $promociones = Cupon::select('titulo')
        //     ->get()
        //     ->toArray();

        $user_id = $request['usuario_id'];
        $user_id2 = $request['usuario_id2'];
        $data = [];
        $referencia_usuario = '';


        if(empty($user_id)){
          $data_respuesta = [
              'status' => 0,
              'error' => 'No user found',
              'data' => $data,
              'sss' => $user_id
          ];
          return response()->json($data_respuesta);
        }



        //
        // $fecha_inicio=null,$fecha_fin=null
        // if(!empty($fecha_inicio)){
        //   $fecha_inicio = ($fecha_inicio);
        // }
        // if(!empty($fecha_fin)){
        //   $fecha_fin = ($fecha_fin);
        // }



        $hoy_dia = date('Y-m-d');




        //PREVIO-----------------------------------------------------------

        // $referenciaSS_usuario = \DB::connection('pickapp_api')
        // ->table('referencia_usuario as referencia_usuario')
        // ->select('referencia.id as referencia_id',
        //          'referencia.nombre as referencia_nombre',
        //          'promociones.promocion_id as promocion_id',
        //          'promociones.promocion_nombre as promocion_nombre',
        //          'promociones.promocion_prioridad as promocion_prioridad',
        //          'promociones.promocion_descuento_flat as promocion_descuento',
        //          'promociones.promocion_cupon_bool as promocion_cupon_bool',
        //          'promociones.promocion_descuento_porcentaje as promocion_descuento_tipo',
        //          'promociones.promocion_cualesservicios as promocion_cualesservicios',
        //          'promociones.promocion_transacciones as promocion_transacciones',
        //          'promociones.tipo_id as tipo_id',
        //          'promociones.promocion_fecha_inicio as promocion_fecha_inicio',
        //          'promociones.promocion_fecha_fin as promocion_fecha_fin'
        //
        //          //'cupones.cupon_id as cupon_id'
        //          )
        // ->where('usuario_id', '=', $user_id)
        //
        // ->leftJoin('referencia as referencia', 'referencia_usuario.referencia_id', '=', 'referencia.id')
        // ->leftJoin('promociones as promociones', 'promociones.tipo_id', '=', 'promociones.tipo_id')
        // //->where('promociones.tipo_id', '=', 'referencia_id')
        // ->whereRaw("find_in_set(referencia_id,promociones.tipo_id)")
        // //->leftJoin($db_api.'.promociones as promociones', 'referencia.id', '=', 'promociones.tipo_id')
        // // ->leftJoin($db_api.'.promociones as promociones', function($leftJoin)
        // // {
        // //     $leftJoin->on('referencia.id', '=', 'promociones.tipo_id');
        // // })
        // //->leftJoin('pickaadmin_pickapp.cupones as cupones', 'promociones.promocion_id', '=', 'cupones.promocion_id')
        // ->where(function($query) use ($hoy_dia) {
        //   $query->where('promociones.promocion_fecha_inicio', '<=', $hoy_dia);
        //   $query->where('promociones.promocion_fecha_fin', '>=', $hoy_dia);
        // })
        // ->get()->toArray();


//PREVIO-----------------------------------------------------------




        $referenciaSS_usuario = \DB::connection('pickapp_api')
        ->table('promociones')
        ->select('referencia.id as referencia_id',
                 'referencia.nombre as referencia_nombre',
                 'promociones.promocion_id as promocion_id',
                 'promociones.promocion_nombre as promocion_nombre',
                 'promociones.promocion_prioridad as promocion_prioridad',
                 'promociones.promocion_descuento_flat as promocion_descuento',
                 'promociones.promocion_cupon_bool as promocion_cupon_bool',
                 'promociones.promocion_descuento_porcentaje as promocion_descuento_tipo',
                 'promociones.promocion_cualesservicios as promocion_cualesservicios',
                 'promociones.promocion_transacciones as promocion_transacciones',
                 'promociones.tipo_id as tipo_id',
                 'promociones.promocion_fecha_inicio as promocion_fecha_inicio',
                 'promociones.promocion_fecha_fin as promocion_fecha_fin',
                 'promociones.promocion_minimo as promocion_minimo'
                 )
        ->where('usuario_id', '=', $user_id)

        ->leftJoin('referencia', 'referencia.id', '=', 'referencia.id')
        ->leftJoin('referencia_usuario', 'referencia_usuario.referencia_id', '=', 'referencia.id')

        ->where(function($query) use ($hoy_dia) {
          $query->where('promociones.promocion_fecha_inicio', '<=', $hoy_dia);
          $query->where('promociones.promocion_fecha_fin', '>=', $hoy_dia);

        })
        ->where(function ($query){
          $query->whereRaw("find_in_set(referencia_id,promociones.tipo_id)");
          $query->orWhere('promociones.tipo_id', '=', NULL);
        })
        ->get()->toArray();




        if(!$referenciaSS_usuario){

            $referenciaSS_usuario = \DB::connection('pickapp_api')
            ->table('promociones')
            ->select(
                     'promociones.promocion_id as promocion_id',
                     'promociones.promocion_nombre as promocion_nombre',
                     'promociones.promocion_prioridad as promocion_prioridad',
                     'promociones.promocion_descuento_flat as promocion_descuento',
                     'promociones.promocion_cupon_bool as promocion_cupon_bool',
                     'promociones.promocion_descuento_porcentaje as promocion_descuento_tipo',
                     'promociones.promocion_cualesservicios as promocion_cualesservicios',
                     'promociones.promocion_transacciones as promocion_transacciones',
                     'promociones.tipo_id as tipo_id',
                     'promociones.promocion_fecha_inicio as promocion_fecha_inicio',
                     'promociones.promocion_fecha_fin as promocion_fecha_fin',
                     'promociones.promocion_minimo as promocion_minimo'


                     )
            ->where(function($query) use ($hoy_dia) {
              $query->where('promociones.promocion_fecha_inicio', '<=', $hoy_dia);
              $query->where('promociones.promocion_fecha_fin', '>=', $hoy_dia);
            })
            ->where(function ($query){
              $query->where('promociones.tipo_id', '=', NULL);
            })
            ->get()->toArray();

        }

        //$aaa=null;



        $hay_promo = 0;
        //$promocion_cupon_bool = 0;
        $promocion_cualesservicios = '';
        $servicios_ar = [];
        $promo_cuantos_usos_van = '';
        //si este usuario tiene tipo:
        if($referenciaSS_usuario){

          //$referencia_usuario = (array)$referencia_usuario;
          //print_r($referencia_usuario);

          //tipo ID
          //$referencia_id = $referencia_usuario['referencia_id'];
          //print_r($referencia_id);
          //print_r("si hay usuario");


          //hay promocion para este tipo?


          foreach ($referenciaSS_usuario as $el) {
          //$el = $referencia_usuario;
              $el = (array)$el;
              $servicio = $el['promocion_cualesservicios'];
              if(!empty($servicio)){
                  $aa = \App\Models\Cupon::serviciosLista($servicio,'plano');
                  $bb = [
                          'promocion_nombre' => $el['promocion_nombre'],
                          'promocion_id' => $el['promocion_id'],
                          'promocion_prioridad' => $el['promocion_prioridad'],
                          'promocion_descuento' => $el['promocion_descuento'],
                          'promocion_descuento_tipo' => $el['promocion_descuento_tipo']==1?'porcentaje':($el['promocion_descuento_tipo']==2?'flat':'-'),
                          'tiene_cupon' => ($el['promocion_cupon_bool']==1)?1:0,
                          'promocion_transacciones' => $el['promocion_transacciones'],
                          'promocion_cualesservicios' => $el['promocion_cualesservicios'],
                          'tipo_id' => $el['tipo_id'],
                          'referencia_id' => isset($el['referencia_id'])?$el['referencia_id']:'TODOS',
                          'promocion_fecha_inicio' => $el['promocion_fecha_inicio'],
                          'promocion_fecha_fin' => $el['promocion_fecha_fin'],
                          'promocion_minimo' => isset($el['promocion_minimo'])?$el['promocion_minimo']:''


                          //'promocion_cupon_bool' => $el['promocion_cupon_bool']
                        ];
                  $servicios_ar[$aa][] = $bb;






                  //$promo_cuantos_usos_van = $request['usuario_id'];

                  $hay_promo = 1;
              }

           }

           // $promo_cuantos_usos_van= \DB::connection('pickapp_api')
           // ->table('descuentos')
           // ->select(\DB::raw('count(descuentos.descuento_tipo_servicio) as descuento_tipo_servicio_n, descuento_tipo_servicio'))
           // ->where('descuentos.usuario_id', '=', $user_id2)
           // ->groupBy('descuentos.descuento_tipo_servicio')
           // ->get()->toArray();

        }else{
          //print_r("no hay usuario");
        }
        // $reserves = Commodity::select(
        //     'commodities.*',
        //     'bins.reserved'
        // )->leftJoin(
        //     DB::raw("
        //         (select
        //             `bins`.`commodity_id`,
        //             sum(`bins`.`capacity`) as `reserved`
        //         from `bins`
        //         where `bins`.`location_id` = ?
        //         group by `bins`.`commodity_id`) `bins`
        //     "), 'commodities.id', '=', 'bins.commodity_id'
        // )
        // ->addBinding($locationId, 'select')
        // ->get();
        // $user_id

        $codigopedidos = Opciones::searchCodigoPedidos(null, null, null, null, 'codigopedido')
        ->toArray();

        $promocion = [
            'hay_promo' =>$hay_promo,
            //'cupon' =>$promocion_cupon_bool,
            'promo_servicios'=>$servicios_ar,
            // 'promo_cuantos_usos_van'=>$promo_cuantos_usos_van,
            //'aaa'=>$aaa,
            // 'cupon_servicios'=>[
            //   'scharff-stop'=>1,
            //   'reserva-regular'=>0,
            //   'scharff-express'=>0
            // ],
        ];

        $data_respuesta = [
          'promocion'=>$promocion,
          'data'=>$referencia_usuario,
          'codigopedidos'=>$codigopedidos['data']
          //'promo'=>$referencia_usuario
        ];




        return response()->json($data_respuesta);
    }



    public function usuario_actualizar_parciales(Request $request){

      $data = $request->all();


      $user_id = $request['usuario_id'];
      $user_id2 = $request['usuario_id2'];
      $usuario_dni = $request['documento'];
      $usuario_movil = $request['movil'];

      $data_respuesta = array(
          'status' => 0,
          'error' => '',
          'data' => []
      );




      $usuario_update = \DB::connection('pickapp_api')
      ->table('usuario')
      ->where('usuario_id', '=', $user_id2)
      ->update(['usuario_dni' => $usuario_dni, 'usuario_movil' => $usuario_movil]);



      $usuario_update_a = \DB::table('users')
      ->where('id', '=', $user_id)
      ->update(['usuario_dni' => $usuario_dni, 'usuario_movil' => $usuario_movil]);


      if($usuario_update&&$usuario_update_a){
        $data_respuesta['status'] = 1;
        $data_respuesta['data'] = 'updated';
        $data_respuesta['usuario_dni'] = $usuario_dni;
        $data_respuesta['usuario_movil'] = $usuario_movil;
      }else{
        $data_respuesta['status'] = 0;
        $data_respuesta['data'] = 'error';
        // $data_respuesta['bb'] = $usuario_update;
        // $data_respuesta['aa'] = $usuario_update_a;
        $data_respuesta['usuario_dni'] = $usuario_dni;
        $data_respuesta['usuario_movil'] = $usuario_movil;
      }








      return response()->json($data_respuesta);



    }



    public function distanciaMap(Request $request){
      $data = $request->all();


      //$key = 'AIzaSyAyP26UJ2oLMouM_ULdlb_i3jQKMX4CwPg';

      $origin = $data['origin'];
      $destination = $data['destination'];

      $key = $data['key'];
      if(!isset($data['key'])){
        $key = 'AIzaSyA4soAMjFo8X_D7yGAVeb4C68T-otDsmuE';
      }



      $test = '';
      if(isset($data['test'])){
        $test = $data['test'];
      };


        $url = 'https://maps.google.com/maps/api/directions/json?key='.$key.'&origin='.$origin.'&destination='.$destination.'&sensor=false&units=metric';


        if (function_exists('curl_init') && $test!='file') {

           $json = file_get_contents($url);
           $json=str_replace('},
           ]',"}
           ]",$json);
           $resp = json_decode($json);
           return response()->json($resp);

        } else if(function_exists('file_get_contents')){

          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
              "postman-token: a8c05e78-f752-fbc7-4725-dbcfbfadacbb"
            ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
            $test="cURL Error #:" . $err;
          } else {
            //sale bien cURL


            $json=str_replace('},
            ]',"}
            ]",$response);
            $resp = json_decode($json);
            return response()->json($resp);

          }

        }else{
          return 'error-init'.$test;
        }




    }
}
