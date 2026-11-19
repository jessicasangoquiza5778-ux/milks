<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'establishment_id', 'estado', 'notas', 'fecha_proxima_gestion'])]
class Opportunity extends Model
{
    use HasFactory;

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
