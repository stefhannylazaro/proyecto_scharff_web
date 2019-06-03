<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UbigeosScharff extends Model
{
    protected $connection = 'pickapp_api';
    protected $table = 'ubigeos_scharff';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
      'CODIGO_UBIGEO',
      'DEPARTAMENTO',
      'PROVINCIA',
      'DISTRITO',
      'CODIGO_CIUDAD',
      'SERVICIO',
      'AEREO_PROPUESTO',
      'TERRESTRE_PROPUESTO',
      'A_TRAVES_DE',
      'OBSERVACION',
      'OPCIONES',
    ];

}
