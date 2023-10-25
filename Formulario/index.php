<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Votación</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
    <h1>Formulario de Votación</h1>

    <form method="post" action="procesar_voto.php" id="formulario" onsubmit="return validarFormulario();">
        <label for="nombre_apellido">Nombre y Apellido:</label>
        <input type="text" id="nombre_apellido" name="nombre_apellido" required><br><br>

        <label for="alias">Alias:</label>
        <input type="text" id="alias" name="alias" required pattern="^(?=.*[a-zA-Z])(?=.*\d).{5,}$">
        
        <label for="rut">RUT (123456789-8):</label>
        <input type="text" id="rut" name="rut" required pattern="\d{7,8}-[\dkK]" oninput="validarRut(this)"><br>
        <span id="rut-error" style="color: red;"></span>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="region">Región:</label>
        <select id="region" name="region">
            <?php
            include('regiones.php');
            echo obtenerRegiones();
            ?>
        </select>

        <label for="comuna">Comuna:</label>
        <select id="comuna" name="comuna">
        <?php
            include('cargar_comuna.php');
            ?>
        </select>

        <label for="candidato">Elige un candidato:</label>
        <select id="candidato" name="candidato" required>
            <option value="">Selecciona un candidato</option>
            <?php
            // Conexión a la base de datos
            $conexion = new mysqli('localhost', 'root', '', 'registro');

            if ($conexion->connect_error) {
                die('Error de conexión a la base de datos: ' . $conexion->connect_error);
            }

            // Consulta SQL para obtener la lista de candidatos
            $sql = "SELECT id_usuario, nombre_usu FROM usuarios";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id_usuario']}'>{$row['nombre_usu']}</option>";
                }
            }

            // Cierra la conexión a la base de datos
            $conexion->close();
            ?>
        </select>

        <label>Selecciona al menos dos opciones:</label><br>
        <input type="checkbox" id="opcion1" name="como_entero[]" value="Web">
        <label for="opcion1">Web</label><br>
        <input type="checkbox" id="opcion2" name="como_entero[]" value="TV">
        <label for="opcion2">TV</label><br>
        <input type="checkbox" id="opcion3" name="como_entero[]" value="Redes Sociales">
        <label for="opcion3">Redes Sociales</label><br>
        <input type="checkbox" id="opcion4" name="como_entero[]" value="Amigo">
        <label for="opcion4">Amigo</label><br>
        <!-- Agrega más opciones de "Cómo se enteró de nosotros" si es necesario -->

        <br><br>
        <input type="submit" value="Votar">
    </form>

    <script>
      
        var regionSelect = document.getElementById('region');
        var comunaSelect = document.getElementById('comuna');
        regionSelect.addEventListener('change', function() {
            comunaSelect.innerHTML = '<option value="">Seleccione una comuna</option>';
            var selectedRegion = regionSelect.value;
            $.ajax({
                type: 'POST',
                url: 'cargar_comuna.php',
                data: { region: selectedRegion },
                success: function(data) {
                    comunaSelect.innerHTML = data;
                }
            });
        });

        function validarFormulario() {
            var nombreApellido = document.getElementById('nombre_apellido').value;
            var alias = document.getElementById('alias').value;
            var rut = document.getElementById('rut').value;
            var email = document.getElementById('email').value;
            var candidato = document.getElementById('candidato').value;
            var opciones = document.querySelectorAll('input[name="como_entero[]"]:checked').length;

            if (nombreApellido === "" || alias === "" || !validarRut(rut) || email === "" || candidato === "" || opciones < 2) {
                alert("Por favor, complete todos los campos obligatorios y asegúrese de ingresar un RUT válido.");
                return false;
            }

            // Agregar más validaciones según tus requisitos

            return true;
        }
    </script>
</body>
</html>
