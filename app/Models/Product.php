<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'nombre', 'categoria', 'descripcion', 'precio_comercio', 'pedido_minimo', 'zonas_entrega'])]
class Product extends Model
{
    use HasFactory;
}
