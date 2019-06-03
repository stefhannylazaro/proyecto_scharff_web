<?php

namespace App\Http\Controllers\Service;

use App\Library\Funciones;
use App\Models\Claimbook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClaimbookController extends Controller
{
    public function get_numero(){

        $data_respuesta =  [
            'status' => 1,
            'error' => '',
            'data' =>
                [
                    'numero_reclamo' => Funciones::generar_numero_reclamo(),
                    'tipo_moneda' => [
                        [
                            'name' => 'Soles',
                            'value' => 'Soles'
                        ],
                        [
                            'name' => 'Dólares',
                            'value' => 'Dólares'
                        ]
                    ],
                    'linea_servicio' => [
                        [
                            'name' => 'Distribución Nacional',
                            'value'=>'distribución-nacional'
                        ],
                        [
                            'name' => 'Aduanas',
                            'value'=>'aduanas'
                        ],
                        [
                            'name' => 'Carga',
                            'value'=>'carga',
                        ],
                        [
                            'name' => 'Almacenes',
                            'value'=>'almacenes'
                        ],
                        [
                            'name' => 'Envíos Internacionales',
                            'value'=>'envios-internacionales'
                        ],
                        [
                            'name' => 'Scharff Express',
                            'value'=>'scharff-express-pickapp'
                        ],
                        [
                            'name' => 'Scharff Stop',
                            'value' => 'scharff-stop-lockers'
                        ]
                    ]
                ]
        ];

        return response()->json($data_respuesta);
    }

    public function save_reclamo(Request $request){
        $data = $request->all();
        $reclamos_email_admin = NULL;
        if (isset($data['reclamos_email_admin'])){
          $reclamos_email_admin = $data['reclamos_email_admin'];
        }
        unset($data['reclamos_email_admin']);
        if (isset($data['imagen_name']) && !empty($data['imagen_name'])) {
          if (!file_exists(config('app.url_image_claim'))) {
              mkdir(config('app.url_image_claim'), 0777, true);
              chmod(config('app.url_image_claim'), 0777);
          }
            $id_aux = Funciones::generar_numero_reclamo();
            $name_photo = $id_aux . '_' . rand(10000000, 99999999);

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


            file_put_contents(config('app.url_image_claim').'/'.$name_f, $file);
            $data['imagen_name'] = $name_f;

        }





        $validator = \Validator::make($data,
            [
                'nombre' => 'required',
                'ubigeo_id'	=>	[
                    'required',
                    'exists:ubigeos,id'
                ],
                'direccion' =>  'required',
                'documento' =>  'required|digits_between:8,15',
                'telefono'  =>  'required|digits_between:9,15',
                'correo'    =>  'required|email',
                'descripcion_menor_edad' => '',
                'bien_contratado' => 'required|in:Producto,Servicio',
                'monto_reclamado' => 'required|numeric',
                'descripcion_bien_contratado'=> '',
                'tipo_reclamo' => 'required|in:Reclamo,Queja',
                'detalle_reclamo' => '',
                'pedido_reclamo' => '',
                'observacion' => '',
                'tipo_moneda' => 'required|in:Soles,Dólares',
                'linea_servicio' => 'required|in:distribución-nacional,aduanas,carga,almacenes,envios-internacionales,scharff-express-pickapp,scharff-stop-lockers'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 0,
                    'error' => $validator->errors()->first(),
                    'data' => []
                ]
            );
        }





        $data['estado_reclamo'] = true;
        $data['fecha_reclamo'] = now();
        $data['numero_reclamo'] = Funciones::generar_numero_reclamo();
        $claimbook = Claimbook::create($data);
        //$claimbook->fill($data);
        //$claimbook->save();
        Funciones::enviar_correo_reclamo($claimbook,$reclamos_email_admin);

        return response()->json(
            [
                'status' => 1,
                'error' => '',
                'data' => [
                    'numero_reclamo' => $claimbook->numero_reclamo,
                    'linea_servicio' => $claimbook->linea_servicio,
                    'tipo_moneda' => $claimbook->tipo_moneda,
                    'fecha_reclamo' => date('Y-m-d H:i:s',strtotime($claimbook->created_at)),
                    'nombre' => $claimbook->nombre,
                    'departamento' => $claimbook->ubigeo->departamento,
                    'provincia' => $claimbook->ubigeo->provincia,
                    'distrito' => $claimbook->ubigeo->distrito,
                    'direccion' => $claimbook->direccion,
                    'documento' => $claimbook->documento,
                    'telefono' => $claimbook->telefono,
                    'correo' => $claimbook->correo,
                    'descripcion_menor_edad' => $claimbook->descripcion_menor_edad? $claimbook->descripcion_menor_edad:'',
                    'bien_contratado' => $claimbook->bien_contratado,
                    'monto_reclamado' => $claimbook->monto_reclamado,
                    'descripcion_bien_contratado' => $claimbook->descripcion_bien_contratado? $claimbook->descripcion_bien_contratado: '',
                    'tipo_reclamo' => $claimbook->tipo_reclamo,
                    'detalle_reclamo' => $claimbook->detalle_reclamo? $claimbook->detalle_reclamo: '',
                    'pedido_reclamo' => $claimbook->pedido_reclamo? $claimbook->pedido_reclamo: '',
                    'observacion' => $claimbook->observacion? $claimbook->observacion: ''
                ]
            ]
        );

    }

}
