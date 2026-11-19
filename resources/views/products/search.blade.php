<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buscar dónde ofrecer: <span class="text-indigo-600">{{ $product->nombre }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline mb-4 inline-block">&larr; Volver al catálogo</a>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <p class="text-yellow-700 text-sm">
                    <strong>Nota:</strong> Los siguientes establecimientos son compatibles, pero la aceptación depende de cada comercio. La compatibilidad no garantiza la venta.
                </p>
            </div>

            @if($establecimientos->isEmpty())
                <div class="bg-white p-6 rounded shadow text-center">
                    <p class="text-gray-500">No encontramos establecimientos que reciban proveedores por ahora.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($establecimientos as $tienda)
                        <div class="bg-white p-4 rounded shadow border-l-4 border-green-500">
                            <h3 class="font-bold text-lg">{{ $tienda->nombre }}</h3>
                            <p class="text-sm text-gray-600"><strong>Tipo:</strong> {{ $tienda->tipo }}</p>
                            <p class="text-sm text-gray-600"><strong>Dirección:</strong> {{ $tienda->direccion }}</p>
                            <p class="text-sm text-gray-600"><strong>Productos que busca:</strong> {{ $tienda->productos_busca ?? 'No especificado' }}</p>
                            
                            <!-- La frase que pide el documento -->
                            <p class="text-xs text-green-700 mt-2 bg-green-50 p-2 rounded">
                                ✔ Vende productos de tu categoría, está dentro de tu cobertura y recibe propuestas.
                            </p>

                            <a href="/tienda/{{ $tienda->id }}" class="mt-4 block text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                                Ver Ficha del Comercio
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

