<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">{{ session('success') }}</div>
                @endif

                <h3 class="text-lg font-bold mb-4">Establecimientos Registrados ({{ $establecimientos->count() }})</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th class="py-2 px-4 border-b">Nombre</th>
                                <th class="py-2 px-4 border-b">Tipo</th>
                                <th class="py-2 px-4 border-b">Verificado</th>
                                <th class="py-2 px-4 border-b">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($establecimientos as $tienda)
                                <tr class="text-sm">
                                    <td class="py-2 px-4 border-b">{{ $tienda->nombre }}</td>
                                    <td class="py-2 px-4 border-b">{{ $tienda->tipo }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @if($tienda->verificado)
                                            <span class="text-green-600 font-bold">Sí</span>
                                        @else
                                            <span class="text-red-600 font-bold">No</span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b">
                                        <form action="{{ route('admin.verificar', $tienda->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                                Cambiar Estado
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
