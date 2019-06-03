<?php

namespace App\Http\Controllers;

use App\Library\Funciones;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Runner\Exception;
use App\Models\MotivoContacto;

class ContactsController extends Controller
{
    public function index()
    {
        //$motivoDetailsObj = MotivoContacto::correoByMotivo('Motivo 4');
        //$motivoDetails = $motivoDetailsObj->toArray()[0];
        //print_r($motivoDetails);
        //print_r($motivoDetails['correo']);
        //return '';
        return Contact::latest()->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:500'
        ]);

        if ($validator->fails()) {

            $result['status'] = false;
            $result['mensaje'] = "Ocurrió un error, Llene todos los campos";

            return $result;

        } else {

            try {
                $obj['empresa'] = request('company');
                $obj['nombre'] = request('name');
                $obj['correo'] = request('email');
                $obj['contacto'] = request('phone');
                $obj['mensaje'] = request('message');
                $obj['motivo'] = request('motivo');
                $obj['servicios'] = request('servicios');

                $contact = Contact::create($obj);

                $motivoDetailsObj = MotivoContacto::correoByMotivo($obj['motivo']);
                $motivoDetails = $motivoDetailsObj->toArray()[0];


                if(!empty($motivoDetails)){
                   Funciones::enviar_correo_contacto($contact, $motivoDetails);
                }
                $result['status'] = true;
                $result['mensaje'] = "Sus datos se enviaron correctamente";

            } catch (QueryException $e) {
                $result['status'] = false;
                echo $e;
                $result['mensaje'] = "Ocurrió un error registrando los datos.";
            }


            return $result;
        }


    }
}
