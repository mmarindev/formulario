<?php
if (isset($_POST['region'])) {
    $selectedRegion = $_POST['region'];

    // Evita posibles ataques de inyección SQL usando sentencias preparadas
    $conexion = new mysqli('localhost', 'root', '', 'registro');
    if ($conexion->connect_error) {
        die('Error de conexión a la base de datos: ' . $conexion->connect_error);
    }

    // Utiliza sentencias preparadas para evitar la inyección SQL
    $sql = "SELECT * FROM provincias WHERE region_id = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conexion->error);
    }

    // Enlaza el parámetro de la región
    $stmt->bind_param("i", $selectedRegion);

    // Ejecuta la consulta preparada
    $stmt->execute();

    // Obtiene los resultados
    $result = $stmt->get_result();

    // Construye las opciones
    $options = '<option value="">Seleccione una comuna</option>';
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='{$row['id_comuna']}'>{$row['comuna']}</option>";
    }

    $stmt->close();
    $conexion->close();
    
    echo $options;
}
?>
