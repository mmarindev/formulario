<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'registro');
if ($conexion->connect_error) {
    die('Error de conexión a la base de datos: ' . $conexion->connect_error);
}

// Función para obtener texto de una tabla según el ID
function obtenerTextoCandidato($id) {
    global $conexion;
    $sql = "SELECT nombre_usu FROM usuarios WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        return "Error al obtener el texto";
    }

    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $stmt->bind_result($texto);
        $stmt->fetch();
        $stmt->close();

        return $texto;
    } else {
        return "Error al obtener el texto";
    }
}

function obtenerTextoRegion($id) {
    global $conexion;
    $sql = "SELECT nombre_region FROM region WHERE id_region = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        return "Error al obtener el texto";
    }

    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $stmt->bind_result($texto);
        $stmt->fetch();
        $stmt->close();

        return $texto;
    } else {
        return "Error al obtener el texto";
    }
}

function obtenerTextoComuna($id) {
    global $conexion;
    $sql = "SELECT comuna FROM provincias WHERE id_comuna = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        return "Error al obtener el texto";
    }

    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $stmt->bind_result($texto);
        $stmt->fetch();
        $stmt->close();

        return $texto;
    } else {
        return "Error al obtener el texto";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreApellido = $_POST["nombre_apellido"];
    $alias = $_POST["alias"];
    $rut = $_POST["rut"];
    $email = $_POST["email"];
    $candidato = obtenerTextoCandidato($_POST["candidato"]);
    $region = obtenerTextoRegion($_POST["region"]);
    $comuna = obtenerTextoComuna($_POST["comuna"]);
    $comoEntero = implode(", ", $_POST["como_entero"]);

    $sql = "INSERT INTO usuarios (nombre_usu, apellido_usu, alias, rut_usu, email, region_usu, comuna_usu, respuesta_ent, candidato) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conexion->error);
    }

    $nombreApellidoArray = explode(" ", $nombreApellido);
    $nombre = $nombreApellidoArray[0];
    $apellido = (count($nombreApellidoArray) > 1) ? $nombreApellidoArray[1] : "";

    $stmt->bind_param("sssssssss", $nombre, $apellido, $alias, $rut, $email, $region, $comuna, $comoEntero, $candidato);

    if ($stmt->execute()) {
        $mensaje = "Los datos se han guardado correctamente.";
    } else {
        $mensaje = "Error al guardar los datos: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Procesamiento de Votación</title>
</head>
<body>
    <?php
    if (isset($mensaje)) {
        echo "<p>$mensaje</p>";
    }
    ?>

    <p><a href="index.php">Volver al formulario principal</a></p>
</body>
</html>
