<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    // ¡Esta es la línea mágica que da el permiso!
    protected $fillable = [
        'nombre', 'tipo', 'direccion', 'parroquia', 'latitud', 
        'longitud', 'telefono', 'horario', 'productos_busca', 
        'recepcion_proveedores', 'verificado', 'user_id'
    ];
}
