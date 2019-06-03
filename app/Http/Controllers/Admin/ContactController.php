<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Mail;
class ContactController extends Controller
{
    private $paginate = 10;

    private $directory = 'contacto';

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
        $models = Contact::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
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
        $obj = Contact::findOrFail($id);
        return view('admin.' . $this->directory . '.view', compact('obj'));
    }



//https://schrf-api-dev.jnq.io/pickapp/api/v1/regular/tarifa?token=f3bd908aa2379051ef1b727c69f9dc4b&ancho=1&altura=1&profundidad=1&peso=1&tiempo=10&destino_ubigeo=259&valor_paquete=&seguro_envio_check=false&destino_distrito=chalhuanca&destino_provincia=aymaraes&destino_departamento=apurimac
//https://schrf-api-dev.jnq.io/pickapp/api/v1/regular/tarifa?token=f3bd908aa2379051ef1b727c69f9dc4b&ancho=1&altura=1&profundidad=1&peso=1&tiempo=10&destino_ubigeo=769&valor_paquete=800&seguro_envio_check=false&destino_distrito=ANDAHUAYLILLAS &destino_provincia=QUISPICANCHI&destino_departamento=CUSCO
    public function download(){


        $request = request()->all();


        \Excel::create('CONTACTOS', function ($excel) use ($request){

            $excel->sheet('Sheetname', function ($sheet) use ($request) {

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
                    'FECHA CREACIÓN',
                    'EMPRESA',
                    'NOMBRE',
                    'CORRE0',
                    'TELÉFONO/CELULAR',
                    'MENSAJE',
                    'MOTIVO',
                    'SERVICIOS',
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


                $models = Contact::search($pager, $search, $column, $order, $fecha_inicio, $fecha_fin);
                $contacts = $models->items();

                for ($i = 0; $i < count($contacts); $i++) {

                    $temp = array(
                        $contacts[$i]->created_at,
                        $contacts[$i]->empresa,
                        $contacts[$i]->nombre,
                        $contacts[$i]->correo,
                        $contacts[$i]->contacto,
                        $contacts[$i]->mensaje,
                        $contacts[$i]->motivo,
                        $contacts[$i]->servicios,
                    );
                    array_push($data, $temp);
                }
                $sheet->rows($data);
            });
        })->export('xlsx');
    }

}
