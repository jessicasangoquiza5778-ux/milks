<?php

namespace App\Imports;

use App\Models\Establishment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EstablishmentsImport implements ToModel, WithStartRow
{
    // Empezamos a leer desde la fila 5 (donde empiezan los datos reales)
    public function startRow(): int
    {
        return 5;
    }

    public function model(array $row)
    {
        // Revisamos si la latitud (columna AC) y longitud (columna AD) están vacías
        // En Excel, AC es la columna 28 (índice 28) y AD es la 29 (índice 29)
        if (!isset($row[28]) || !isset($row[29]) || $row[28] == '' || $row[29] == '') {
            return null; 
        }

        // Limpiamos las comas de las coordenadas por si acaso
        $lat = str_replace(',', '.', $row[28]);
        $lng = str_replace(',', '.', $row[29]);

        // Si la latitud es 0, lo saltamos
        if ((float)$lat == 0) {
            return null;
        }

        return new Establishment([
            'nombre'                => $row[2] ?? 'Sin nombre',       // Columna C
            'tipo'                  => $row[4] ?? 'Tienda',           // Columna E
            'direccion'             => $row[5] ?? 'Sin dirección',    // Columna F
            'parroquia'             => $row[8] ?? '',                 // Columna I
            'latitud'               => (float) $lat,                  // Columna AC
            'longitud'              => (float) $lng,                  // Columna AD
            'telefono'              => $row[10] ?? '',                // Columna K
            'horario'               => $row[12] ?? '',                // Columna M
            'productos_busca'       => $row[15] ?? '',                // Columna P
            'recepcion_proveedores' => $row[17] ?? 'Por confirmar',   // Columna R (o S)
            'verificado'            => true, 
        ]);
    }
}
