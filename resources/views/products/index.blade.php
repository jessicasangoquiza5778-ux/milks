<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mi Catálogo de Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <a href="{{ route('products.create') }}" style="background-color: #3b82f6; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                        + Agregar Nuevo Producto
                    </a>
                </div>

                @if($products->isEmpty())
                    <p class="text-gray-500 mt-4">Aún no tienes productos registrados en tu catálogo.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @foreach($products as $product)
                            <div class="border p-4 rounded shadow flex flex-col justify-between bg-gray-50">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $product->nombre }}</h3>
                                    <p class="text-sm text-indigo-600 font-semibold">{{ $product->categoria }}</p>
                                    <p class="text-sm mt-2 text-gray-600">{{ $product->descripcion }}</p>
                                </div>
                                <div>
                                    <div class="mt-4 flex justify-between items-center text-sm border-t pt-2">
                                        <span class="font-bold text-green-600">${{ $product->precio_comercio }}</span>
                                        <span class="text-gray-500">Mínimo: {{ $product->pedido_minimo }}</span>
                                    </div>
                                    
                                    <a href="{{ route('products.search', $product->id) }}" style="display: block; text-align: center; margin-top: 15px; background-color: #6366f1; color: white; padding: 10px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                                        🔍 Buscar dónde ofrecerlo
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
