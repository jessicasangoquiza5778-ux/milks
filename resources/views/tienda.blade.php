<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tienda->nombre }} - Ficha</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 md:p-8 font-sans">

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        
        <!-- Botón para volver atrás inteligente -->
        <a href="javascript:history.back()" class="text-blue-500 hover:underline text-sm font-bold">&larr; Volver atrás</a>
        
        <h2 class="text-2xl font-bold text-gray-800 mt-4 mb-2">{{ $tienda->nombre }}</h2>
        
        @if($tienda->verificado)
            <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Información Verificada</span>
        @else
            <span class="bg-gray-100 text-gray-800 text-xs font-bold px-2.5 py-0.5 rounded">Pendiente de verificar</span>
        @endif

        <hr class="my-4">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
            <p><strong>Tipo de comercio:</strong> {{ $tienda->tipo }}</p>
            <p><strong>Horario:</strong> {{ $tienda->horario }}</p>
            <p><strong>Dirección:</strong> {{ $tienda->direccion }}</p>
            <p><strong>Parroquia:</strong> {{ $tienda->parroquia }}</p>
            <p><strong>Teléfono:</strong> {{ $tienda->telefono ?? 'No registrado' }}</p>
            <p><strong>Recibe proveedores:</strong> {{ $tienda->recepcion_proveedores }}</p>
        </div>
        
        <div class="mt-4 p-4 bg-gray-50 rounded border text-sm text-gray-700">
            <p><strong>Productos que busca:</strong><br> {{ $tienda->productos_busca ?? 'No especificado' }}</p>
        </div>

        <hr class="my-6">
        
        <!-- Acciones principales -->
        <div class="flex flex-col md:flex-row gap-4 justify-center mt-4">
            
            <!-- Botón de WhatsApp -->
            <a href="https://wa.me/{{ $tienda->telefono }}?text=Hola,%20vengo%20de%20la%20app%20Milkis.%20Me%20interesa%20ofrecer%20mis%20productos." target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded text-center">
                📞 Contactar por WhatsApp
            </a>

            <!-- Botón de Guardar Oportunidad -->
            <form action="{{ route('opportunities.store') }}" method="POST">
                @csrf
                <input type="hidden" name="establishment_id" value="{{ $tienda->id }}">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded">
                    ⭐ Guardar Oportunidad
                </button>
            </form>
            
        </div>

        <!-- Botón de Cómo llegar -->
        <div class="text-center mt-4">
            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $tienda->latitud }},{{ $tienda->longitud }}" target="_blank" class="text-sm text-blue-500 hover:underline">
                📍 Cómo llegar (Google Maps)
            </a>
        </div>

    </div>

</body>
</html>
