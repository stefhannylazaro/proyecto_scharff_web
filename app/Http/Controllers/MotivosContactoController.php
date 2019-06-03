<?php

namespace App\Http\Controllers;

use App\Library\Funciones;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Runner\Exception;
use App\Models\MotivoContacto;

class MotivosContactoController extends Controller
{
    public function index(Request $request)
    {
        $items = MotivoContacto::latest()->orderBy('orden', 'ASC')->get();
        return ['MotivoContacto' => $items];

        //$result['mensaje'] = "Ocurrió un error registrando los datos.";
        //return $result;
    }
}
