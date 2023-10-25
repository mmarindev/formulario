<?php
function obtenerRegiones() {
    // Intenta establecer una conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'registro');

    // Verifica si hay errores de conexión
    if ($conexion->connect_error) {
        die('Error de conexión a la base de datos: ' . $conexion->connect_error);
    }

    // Consulta SQL para obtener las regiones
    $sql = 'SELECT * FROM region';

    // Ejecuta la consulta
    $result = $conexion->query($sql);

    // Verifica si la consulta se ejecutó correctamente
    if ($result === false) {
        die('Error al ejecutar la consulta: ' . $conexion->error);
    }

    // Inicializa la variable $options
    $options = '<option value="">Seleccione una región</option>';

    // Genera las opciones basadas en los resultados
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['id_region']}'>{$row['nombre_region']}</option>";
    }

    // Cierra la conexión a la base de datos
    $conexion->close();

    return $options;
}

// Llama a la función obtenerRegiones() para obtener las opciones
echo obtenerRegiones();
?>
