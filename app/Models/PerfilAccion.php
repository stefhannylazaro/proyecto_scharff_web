<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilAccion extends Model
{
    protected $table = 'perfil_accion';

    protected $guarded = [];

    public static function verificarAcceso($base_ruta){
        $perfil = auth()->user()->administrator->perfil_id;

        $permiso = PerfilAccion::join('accion','accion.id','=','perfil_accion.accion_id')
            ->where('accion.base_ruta', $base_ruta )
            ->where('perfil_accion.perfil_id', $perfil )
            ->where('perfil_accion.estado', 1)->first();

        return $permiso? 1:0;
    }
}
