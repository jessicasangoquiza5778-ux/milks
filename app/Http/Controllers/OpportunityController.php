<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{
    public function index()
    {
        $oportunidades = Opportunity::with('establishment')->where('user_id', Auth::id())->get();
        return view('opportunities.index', compact('oportunidades'));
    }

    public function store(Request $request)
    {
        Opportunity::create([
            'user_id' => Auth::id(),
            'establishment_id' => $request->establishment_id,
            'estado' => 'Por contactar'
        ]);
        return back()->with('success', '¡Oportunidad guardada con éxito!');
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        if($opportunity->user_id !== Auth::id()) abort(403);
        $opportunity->update([
            'estado' => $request->estado,
            'notas' => $request->notas,
            'fecha_proxima_gestion' => $request->fecha_proxima_gestion
        ]);
        return back()->with('success', 'Seguimiento actualizado.');
    }
}
