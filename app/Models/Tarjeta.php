<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    protected $guarded = [];
    protected $table = 'tarjeta';
    protected $connection = 'pickapp_api';
    protected $primaryKey = 'tarjeta_id';

}
