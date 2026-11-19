<?php

namespace App\Http\Controllers;

use App\Models\Establishment;

class EstablishmentController extends Controller
{
    public function show($id)
    {
        $tienda = Establishment::findOrFail($id);
        return view('tienda', compact('tienda'));
    }
}
