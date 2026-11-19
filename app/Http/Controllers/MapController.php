<?php

namespace App\Http\Controllers;

use App\Models\Establishment;

class MapController extends Controller
{
    public function index()
    {
        // Traemos todos los establecimientos de la base de datos
        $establishments = Establishment::all();
        return view('map', compact('establishments'));
    }
}
