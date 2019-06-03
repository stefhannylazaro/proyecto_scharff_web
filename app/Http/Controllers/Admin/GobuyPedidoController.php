<?php

namespace App\Http\Controllers\Admin;

use App\Models\GobuyPedido;
use App\Library\Funciones;
use App\Models\Consolidado;
use App\Models\OpcionesGenerales;
use App\Models\Opciones;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tarjeta;
use Culqi\Culqi;

class GobuyPedidoController extends Controller
{
    private $paginate = 10;

    private $directory = 'gobuypedido';

    public function index($column = null, $order = null)
    {
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = GobuyPedido::search($pager, $search, $column, $order);
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

    public function list_consolidado($type = null,$column = null, $order = null)//add
    {   //$type=0;
        $requestC = request()->all();
        $pager = @$requestC['pager'] ? $requestC['pager'] : $this->paginate;
        $search = @$requestC['search'] ? $requestC['search'] : null;
        $modelsC = Consolidado::search($pager, $search, $column, $order);
        $orderC = ($order == 'asc') ? 'desc' : 'asc';

        return view('admin.' . $this->directory . '.index', compact(
            'modelsC',
            'pager',
            'search',
            'column',
            'order',
            'requestC'
        ));
    }
    //new
    public function index1($type = null,$column = null, $order = null)//add
    {   //$type=0;
        $request = request()->all();
        $pager = @$request['pager'] ? $request['pager'] : $this->paginate;
        $search = @$request['search'] ? $request['search'] : null;
        $models = GobuyPedido::searchType($pager, $search, $column, $order, $type);
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
    //



    public function view($id){
        $obj = GobuyPedido::findOrFail($id);

        return view('admin.' . $this->directory . '.view', compact('obj'));
    }



    public function edit($id){
        $model = GobuyPedido::findOrFail($id);
        try
        {
            @$usuario = Usuario::find($model->usuario_id);
            if(!@$usuario){
              $model->usuario_email='';
            } else {
              $model->usuario_email=$usuario->usuario_email;
            }

            return view('admin.' . $this->directory . '.view', compact('model'));
        }
        catch (ModelNotFoundException $e)
        {
            echo ($e->getMessage());
            return "";
        }
    }



    public function update(Request $request,$id){
        $data = $request->all();
        $model = GobuyPedido::findOrFail($id);
        //
        if (isset($data['gobuy_confirmacioncompra']) && !empty($data['gobuy_confirmacioncompra'])) {
            $name_photo = $model->gobuy_id . '_' . rand(10000000, 99999999);
            $name_photo = $name_photo . '.' . $data['gobuy_confirmacioncompra']->getClientOriginalExtension();
            $data['gobuy_confirmacioncompra']->move("elements/gobuy", $name_photo);
            $data['gobuy_confirmacioncompra'] = $name_photo;

             // if (file_exists("elements/gobuy". $model->gobuy_confirmacioncompra)) {
             //     unlink("elements/gobuy". $model->gobuy_confirmacioncompra);
             // }
         }

         // if(!$data['gobuy_cobrofinal']) {
         //   if(isset($data['gobuy_montoextra'])){//cambio monto
         //     if($data['gobuy_montoextra']>0){
         //       //cobrar
         //     } else {
         //       //devolucion
         //     }
         //   }
         // }


         /*cotizador*/
         // if($data['gobuy_valordeclarado']>200){
         //   $aux_monto_c= floor( ($data['gobuy_valordeclarado']/100) * 10) / 10;
         // } else {
         //   $aux_monto_c= 0;
         // }
         // $cotizador=16.15 + 7.25*$data['gobuy_peso'] + $aux_monto_c;

         /*tarifador*/
         //7,25*PESO +  SI(PRECIO>200;(REDONDEAR.MENOS(PRECIO/100;1));0)  +  (PESO/PESO CONSOLIDADO)*(100+56+5,45)
         // $aux_peso=($data['gobuy_peso']/$data['gobuy_pesoconsolidado']) *(161.45);//OBSERVADO /1 (es un valor PESO CONSOLIDADO **VER DE DONDE SALE)
         // $tarifador=7.25*$data['gobuy_peso'] + $aux_monto_c + $aux_peso;
         //
         // if($tarifador+($cotizador/10) > $cotizador) {
         //   $data['gobuy_costoenvio']=round($cotizador,2);
         // } else {
         //   $data['gobuy_costoenvio']=round($tarifador,2);
         // }
         $panel = 0;
         if(isset($data['gobuy_estado'])){
           $panel = $data['gobuy_estado'];
         }

        $model->fill($data);
        $model->save();

        return redirect()->route('adm.gobuypedido.type',$panel)->with('mensaje','Pedido actualizado con éxito!!');
        return view('admin.' . $this->directory . '.view', compact('model'));
    }

    //calculo costo real
    public function get_costo_real(Request $request){
        try {
          $data = $request->all();
          $costo_cobrado=$data['costo_cobrado'];
           /*cotizador*/
           if($data['valor_real']<=200){
             //$aux_monto_c= floor( ($data['valor_real']/100) * 10) / 10;
             $aux_monto_c= 5;
           } else {
             if($data['valor_real']>200 && $data['valor_real']<=2000) {
               $aux_monto_c= 8;
             } else {
               $aux_monto_c= 75;
             }
           }
           $cotizador = ( ( $aux_monto_c + 5.5*round($data['peso_real'],1) ) +2.5 )/0.7;

           /*tarifador*/
           // $aux_peso=($data['peso_real']/1) *(161.45);//OBSERVADO /1 (es un valor PESO CONSOLIDADO)
           // $tarifador=7.25*$data['peso_real'] + $aux_monto_c + $aux_peso;

           // if($tarifador+($cotizador/10) > $cotizador) {
           $costo_real=round($cotizador,2)*1.18;
           // } else {
           //   $costo_real=round($tarifador,2)+round($data['impuesto'],2);
           // }
           $costo_real=round($costo_real,2)+round($data['impuesto'],2);//nuevo cambio

           $saldo=round($costo_real-$costo_cobrado,2);
           $data = [
             'costo_real' => round($costo_real,1),
             'saldo' => round($saldo),
             'cambio_costo' => $saldo==0? 0:1
           ];
           $data_respuesta =  [
             'status' => 1,
             'data'=> $data,
             'mensajes' => ['Respuesta exitosa.']
           ];

        } catch (\Exception $e) {
          $data_respuesta =  [
            'status' => 2,
            'mensajes' => ['Error al calcular costo real.']
          ];
        }



        return response()->json($data_respuesta);
    }
    //fin calculo

    public function create(){
        return view('admin.' . $this->directory . '.create');
    }

    public function save(Request $request){//Registro de la misma forma que en la parte publica

        $data = $request->all();
        $model = GobuyPedido::create($data);
        if (isset($data['gobuy_confirmacioncompra']) && !empty($data['gobuy_confirmacioncompra'])) {
          if (!file_exists("elements/gobuy")) {
              mkdir("elements/gobuy", 0777, true);
              chmod("elements/gobuy", 0777);
          }

          $name_photo = $model->gobuy_id . '_' . rand(10000000, 99999999);
          $name_photo = $name_photo . '.' . $data['gobuy_confirmacioncompra']->getClientOriginalExtension();
          $data['gobuy_confirmacioncompra']->move("elements/gobuy", $name_photo);
          $data['gobuy_confirmacioncompra'] = $name_photo;


          @$modelUsuario = Usuario::where('usuario_email','=',$data['usuario_email'])->first();
          if(!@$modelUsuario){ //usuario no encontrado
            $data['usuario_id']= '';
          } else {
            $data['usuario_id']= $modelUsuario->usuario_id;
          }

          $serie = OpcionesGenerales::findOrFail(7);
          $tamano = OpcionesGenerales::findOrFail(8);
          $siguienteNumero = OpcionesGenerales::findOrFail(9);//add
          //actualizar opcionen general siguiente numero
          OpcionesGenerales::where('id', 9)->update(['valor' => $siguienteNumero->valor+1]);
          //
          $auxTamano='';
          $numlength = strlen((string)$siguienteNumero->valor);
          $ceros = (int)$tamano->valor - $numlength;
          for ($i = 0; $i < $ceros; $i++){
            $auxTamano=$auxTamano."0";
          }

          $data['gobuy_codetracking']= $serie->valor.$auxTamano.$siguienteNumero->valor;
          $data['gobuy_estado']=0;//recibido
          /*cotizador antes*/
          // if($data['gobuy_valordeclarado']>200){
          //   $aux_monto_c= floor( ($data['gobuy_valordeclarado']/100) * 10) / 10;
          // } else {
          //   $aux_monto_c= 0;
          // }
          // $cotizador=16.15 + 7.25*$data['gobuy_peso'] + $aux_monto_c;


          /*cotizador*/
          if($data['gobuy_valordeclarado']<=200){
            //$aux_monto_c= floor( ($data['valor_real']/100) * 10) / 10;
            $aux_monto_c= 5;
          } else {
            if($data['gobuy_valordeclarado']>200 && $data['gobuy_valordeclarado']<=2000) {
              $aux_monto_c= 8;
            } else {
              $aux_monto_c= 75;
            }
          }
          $cotizador = ( ( $aux_monto_c + 5.5*round($data['gobuy_peso'],1) ) +2.5 )/0.7;

          $data['gobuy_costoenvio']=round($cotizador,2)*1.18;
          /*tarifador*/
          // $aux_peso=($data['gobuy_peso']/1) *(161.45);//OBSERVADO /1 (es un valor PESO CONSOLIDADO)
          // $tarifador=7.25*$data['gobuy_peso'] + $aux_monto_c + $aux_peso;

          // if($tarifador + ($cotizador/10) > $cotizador) {
          //   $data['gobuy_costoenvio']=round($cotizador,2);
          // } else {
          //   $data['gobuy_costoenvio']=round($tarifador,2);
          // }

          $model->fill($data);
          $model->save();
        }
        return redirect()->route('adm.' . $this->directory . '.index')->with('mensaje','Pedido creado con éxito!!');;
    }

    //gobuy detalle
    public function get_info_gobuy(Request $request){
        $data = $request->all();
        try {
          $direccion = Opciones::findOrFail(21);
          $city = Opciones::findOrFail(22);
          $phone = Opciones::findOrFail(23);
          $modelUsuario = Usuario::findOrFail($data['usuario_id2']);

          // if(!isset($modelUsuario->usuario_name_gobuy)){
          //   $nombre = str_replace(' ', '', $modelUsuario->usuario_nombre);
          //   $nombre=Funciones::quitar_tildes($nombre);
          //   $num=Funciones::read_number(rand(1, 100));
          //   $num = str_replace(' ', '', $num);
          //   $modelUsuario->usuario_name_gobuy='SCHARFF '.$nombre;
          // }
          // else {
          //   $nombre=$modelUsuario->usuario_name_gobuy;
          // }
          $nombre=$modelUsuario->usuario_nombre.' '.$modelUsuario->usuario_apellidos;
          //$nombre = str_replace(' ', '', $nom);
          $nombre=Funciones::quitar_tildes($nombre);
          $nombre=ucwords($nombre);
          //$modelUsuario->save();
          $data =  [
              'direccion' => $direccion->valor,
              'ciudad'=> $city->valor,
              'telefono'=> $phone->valor,
              'nombre' => 'Scharff '.$nombre
          ];
            $data_respuesta =  [
              'status' => 1,
              'data'=> $data,
              'mensajes' => ['Respuesta exitosa.']
          ];


        } catch (\Exception $e) {
          $data_respuesta =  [
            'status' => 2,
            'mensajes' => ['Error al cargar información.']
          ];
        }
        return response()->json($data_respuesta);
    }
    //***

    public function change_status(Request $request){
        try {
          $data = $request->all();
          $items=$data['list'];
          for ($i=0; $i < count($items); $i++) {
            $model=GobuyPedido::findOrFail($items[$i]);
            if($data['estado']==1){//a recibido en Miami
              if($model->gobuy_fecharecepcion=="" || $model->gobuy_fecharecepcion==0 || $model->gobuy_fecharecepcion==''){
                $data_respuesta =  [
                  'status' => 2,
                  'mensajes' => ['Los campos: Fecha de recepción y piezas, son obligatorios.']
                ];
                return response()->json($data_respuesta);
              }
            }

            if($data['estado']==4) {//a entregado
              if($model->gobuy_pesoreal=="" ||  $model->gobuy_costoreal=="") {
                $data_respuesta =  [
                  'status' => 2,
                  'mensajes' => ['Se debe ingresar las cantidades reales: valor real y peso real.']
                ];
                return response()->json($data_respuesta);
              }
            }

            $model->gobuy_estado=$data['estado'];
            $model->save();
          }
          $data_respuesta =  [
            'status' => 1,
            'mensajes' => ['Se guardo con éxito.']
          ];
        } catch (\Exception $e) {
          $data_respuesta =  [
            'status' => 2,
            'mensajes' => ['Error al actualizar estado.']
          ];
        }
        return response()->json($data_respuesta);
    }

    public function update_consolidado(Request $request){//cambia de estado pedidos y borra consolidado
      //id  Consolidado
      //estado
        try {
          $data = $request->all();
          $model=Consolidado::findOrFail($data['id'])->update(['estado' => 0]);
          $modelGobuy = GobuyPedido::where('consolidado_id','=',$data['id'])->update(['gobuy_estado' => $data['estado']]);

          $data_respuesta =  [
            'status' => 1,
            'mensajes' => ['Se guardo con éxito.']
          ];
        } catch (\Exception $e) {
          $data_respuesta =  [
            'status' => 2,
            'mensajes' => ['Error al actualizar estado.']
          ];
        }
        return response()->json($data_respuesta);
    }

    public function change_status_byconsolidado(Request $request){//cambia de estado pedidos que estan asociados a un consolidado
      //todos los pedidos del consolidado están en tránsito sino aparecerá un mensaje
        try {
          $data = $request->all();
          $model=GobuyPedido::findOrFail($data['id']);
          $idCons=$model->consolidado_id;
          $modelCons=Consolidado::findOrFail($idCons);

          //if($modelCons->estado){
            $modelCons->estado=1;
            $modelCons->save();
            //$modelGobuy = GobuyPedido::where('consolidado_id','=',$idCons)->update(['gobuy_estado' => $data['estado']]);
            $modelGobuy = GobuyPedido::where('consolidado_id','=',$idCons)->get()->toArray();
            $aux=1;
            foreach ($modelGobuy as $key => $gobuy){
              if($gobuy['gobuy_estado']==3) {// en almacen
                $gobuyFind = GobuyPedido::find($gobuy['usuario_id']);
              } else {
                $aux=0;
              }
            }
            if($aux){//todos los pedidos estan en almacen
              GobuyPedido::where('consolidado_id','=',$idCons)->update(['gobuy_estado' => $data['estado']]);
              $data_respuesta =  [
                'status' => 1,
                'mensajes' => ['Se guardo con éxito.']
              ];
            } else {
              $data_respuesta =  [
                'status' => 2,
                'mensajes' => ['No se puede regresar a estado en tránsito,<br> debe tener todos los pedidos en estado En almacén Scharff.']
              ];
            }

          // } else {
          //   $data_respuesta =  [
          //     'status' => 2,
          //     'mensajes' => ['El consolidado asociado al pedido fue eliminado.']
          //   ];
          // }

        } catch (\Exception $e) {
          $data_respuesta =  [
            'status' => 2,
            'mensajes' => ['Error al actualizar estado.']
          ];
        }
        return response()->json($data_respuesta);
    }


    public function save_gobuypedido(Request $request){
        $data = $request->all();
        if (isset($data['imagen_name']) && !empty($data['imagen_name'])) {
          if (!file_exists("elements/gobuy")) {

              mkdir("elements/gobuy", 0777, true);
              chmod("elements/gobuy", 0777);
          }
            //$id_aux = Funciones::generar_numero_reclamo();
            $fecha = date_create();
            $date_timestamp =  date_timestamp_get($fecha);
            $name_photo = "gobuy" . '_' . $date_timestamp;

            $img = explode(',', $data['imagen_name']);
            $ini =substr($img[0], 11);
            $type = explode(';', $data['imagen_name']);
            $ext_a = explode('/',  $type[0]);// result data:image/png
            $ext = '.'.$ext_a[1]; // result .png
            //echo $type[0].';base64,';

            $name_f = $name_photo.$ext;
            $datai = str_replace($type[0].';base64,', '', $data['imagen_name']);
            $datai = str_replace(' ', '+', $datai);

            $file = base64_decode($datai);


            file_put_contents("elements/gobuy".'/'.$name_f, $file);
            $data['imagen_name'] = $name_f;
            $data['gobuy_confirmacioncompra'] = $data['imagen_name'];
            $gobuyPedido = GobuyPedido::where('gobuy_id', $data['gobuy_id'])->update(['gobuy_confirmacioncompra' => $data['imagen_name']]);
        }



        $data_respuesta =  [
          'tipo' => 1,
          'mensajes' => ['Se guardo con éxito.'],
          'data' => $gobuyPedido,
          'datab' => $data
        ];

        return response()->json($data_respuesta);

    }












}
