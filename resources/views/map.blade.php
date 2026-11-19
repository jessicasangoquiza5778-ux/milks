<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Oportunidades - Milkis</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body { margin: 0; padding: 0; font-family: sans-serif; }
        #map { height: 100vh; width: 100%; }
        #search-bar {
            position: absolute; top: 10px; left: 50px; z-index: 1000;
            background: white; padding: 10px; border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            display: flex; gap: 10px;
        }
        input, select { padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 8px 15px; background: #3490dc; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #2779bd; }
    </style>
</head>
<body>

    <!-- Barra de Búsqueda y Filtros -->
    <div id="search-bar">
        <input type="text" id="search-input" placeholder="Buscar por nombre o sector...">
        <select id="filter-type">
            <option value="todos">Todos los tipos</option>
            <option value="Tienda">Tiendas</option>
            <option value="Minimarket">Minimarkets</option>
            <option value="Supermercado">Supermercados</option>
            <option value="Distribuidor">Distribuidores</option>
        </select>
        <button onclick="filtrarMapa()">Buscar</button>
    </div>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inicializamos el mapa
        var map = L.map('map').setView([-0.78, -78.62], 12);

        // Cargamos OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Pasamos los datos de Laravel a JavaScript
        var establishments = @json($establishments);
        
        // Capa para guardar los marcadores
        var markersLayer = L.layerGroup().addTo(map);

        // Función para dibujar los marcadores
        function dibujarTiendas(tiendasFiltradas) {
            markersLayer.clearLayers(); // Limpiamos el mapa
            
            tiendasFiltradas.forEach(function(tienda) {
                if(tienda.latitud && tienda.longitud) {
                    // Colores según el tipo de tienda
                    var color = '#3490dc'; // Azul por defecto
                    if(tienda.tipo === 'Supermercado') color = 'red';
                    if(tienda.tipo === 'Minimarket') color = 'green';
                    if(tienda.tipo === 'Distribuidor') color = 'orange';

                    var marker = L.circleMarker([tienda.latitud, tienda.longitud], {
                        color: color, radius: 8, fillOpacity: 0.8
                    }).addTo(markersLayer);
                    
                    // Ventana emergente al hacer clic
                    marker.bindPopup(`
                        <div style="font-family: sans-serif;">
                            <b>${tienda.nombre}</b><br>
                            <span style="font-size:12px; color:#666;">Tipo: ${tienda.tipo}</span><br>
                            <span style="font-size:12px;">${tienda.direccion}</span><br><br>
                            <a href="/tienda/${tienda.id}" style="display:block; margin-bottom:5px; background:#3490dc; color:white; padding:5px; text-align:center; text-decoration:none; border-radius:3px;">Ver Ficha Completa</a>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${tienda.latitud},${tienda.longitud}" target="_blank" style="display:block; text-align:center; font-size:12px;">Cómo llegar</a>
                        </div>
                    `);
                }
            });
        }

        // --- AQUI SE DIBUJAN LAS TIENDAS AL INICIAR ---
        dibujarTiendas(establishments); 

        // Función para el buscador
        function filtrarMapa() {
            var texto = document.getElementById('search-input').value.toLowerCase();
            var tipo = document.getElementById('filter-type').value;

            var filtradas = establishments.filter(function(t) {
                // Busca en nombre, dirección o parroquia
                var coincideTexto = (t.nombre && t.nombre.toLowerCase().includes(texto)) || 
                                    (t.direccion && t.direccion.toLowerCase().includes(texto)) ||
                                    (t.parroquia && t.parroquia.toLowerCase().includes(texto));
                
                // Busca el tipo
                var coincideTipo = (tipo === 'todos') || (t.tipo === tipo);
                
                return coincideTexto && coincideTipo;
            });

            dibujarTiendas(filtradas);
        }
    </script>
</body>
</html>
