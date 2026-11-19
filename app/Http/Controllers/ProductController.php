<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Establishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string',
            'descripcion' => 'required|string',
            'precio_comercio' => 'required|numeric|min:0',
            'pedido_minimo' => 'required|integer|min:1',
            'zonas_entrega' => 'nullable|string',
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'precio_comercio' => $request->precio_comercio,
            'pedido_minimo' => $request->pedido_minimo,
            'zonas_entrega' => $request->zonas_entrega,
        ]);

        return redirect()->route('products.index')->with('success', '¡Producto registrado con éxito!');
    }

    // NUEVA FUNCIÓN: Buscar dónde ofrecerlo
    public function search(Product $product)
    {
        // Buscamos tiendas que busquen algo similar a la categoría o nombre del producto
        // y que además estén dispuestas a recibir proveedores.
        $establecimientos = Establishment::where('recepcion_proveedores', 'Si')
            ->orWhere('recepcion_proveedores', 'Por confirmar')
            ->orWhere('recepcion_proveedores', 'Sí')
            ->get();

        return view('products.search', compact('product', 'establecimientos'));
    }
}
