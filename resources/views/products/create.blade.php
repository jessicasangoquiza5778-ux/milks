<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nombre del Producto</label>
                        <input type="text" name="nombre" class="w-full border-gray-300 rounded shadow-sm" required placeholder="Ej. Queso Fresco Artesanal">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Categoría</label>
                        <select name="categoria" class="w-full border-gray-300 rounded shadow-sm" required>
                            <option value="Lácteos">Lácteos</option>
                            <option value="Alimentos">Alimentos</option>
                            <option value="Bebidas">Bebidas</option>
                            <option value="Limpieza">Limpieza</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Descripción</label>
                        <textarea name="descripcion" rows="3" class="w-full border-gray-300 rounded shadow-sm" required placeholder="Describe tu producto, presentación y vida útil..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Precio al Comercio ($)</label>
                            <input type="number" step="0.01" name="precio_comercio" class="w-full border-gray-300 rounded shadow-sm" required placeholder="1.50">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Pedido Mínimo</label>
                            <input type="number" name="pedido_minimo" class="w-full border-gray-300 rounded shadow-sm" required placeholder="10" value="1">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Zonas de Entrega</label>
                        <input type="text" name="zonas_entrega" class="w-full border-gray-300 rounded shadow-sm" placeholder="Ej. Latacunga Centro, Tanicuchi...">
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">Cancelar</a>
                        <!-- ESTE ES EL BOTÓN DE GUARDAR -->
                        <button type="submit" style="background-color: #10b981; color: white; padding: 10px 24px; border-radius: 5px; font-weight: bold; border: none; cursor: pointer;">
                            Guardar Producto
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
