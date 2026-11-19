<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if(auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso de administrador.');
        }

        $establecimientos = Establishment::all();
        return view('admin.index', compact('establecimientos'));
    }

    public function verificar($id)
    {
        if(auth()->user()->role !== 'admin') abort(403);
        
        $tienda = Establishment::findOrFail($id);
        $tienda->update(['verificado' => !$tienda->verificado]);
        
        return back()->with('success', 'Estado de verificación actualizado.');
    }
}
