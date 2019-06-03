<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferenciaUsuario extends Model
{
    protected $guarded = [];
    protected $table = 'referencia_usuario';
    protected $connection = 'pickapp_api';

}
