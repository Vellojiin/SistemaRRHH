<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reclutamiento</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-800 text-white">
    <nav class="bg-gray-900 p-4">
        <!-- Navbar content -->
        <div class="container mx-auto flex justify-between">
            <h1 class=" text-2xl text-white">Sistema de Reclutamiento SoftCorp & Co</h1>
            <ul class="flex">
                <li class="mr-6">
                    <a href="index.php" class="text-xl text-white">Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mx-auto p-4">
        <form method="POST" action="home.php">
            <div class="mb-4">
                <input type="text" name="cedula" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Cédula o Pasaporte" required>
            </div>
            <div class="mb-4">
                <input type="text" name="nombre" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Nombre" required>
            </div>
            <div class="mb-4">
                <input type="text" name="apellido" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Apellido" required>
            </div>
            <div class="mb-4">
                <select name="estado_civil" class="form-control bg-gray-700 text-white border-none p-2 w-full" required>
                    <option value="" disabled selected>Estado Civil</option>
                    <option value="soltero">Soltero</option>
                    <option value="casado">Casado</option>
                    <option value="divorciado">Divorciado</option>
                    <option value="viudo">Viudo</option>
                </select>
            </div>
            <div class="mb-4">
                <select name="genero" class="form-control bg-gray-700 text-white border-none p-2 w-full" required>
                    <option value="" disabled selected>Genero</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>
            <div class="mb-4">
                <select name="tipo_sangre" class="form-control bg-gray-700 text-white border-none p-2 w-full" required>
                    <option value="" disabled selected>Tipo de Sangre</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <div class="mb-4">
                <input type="date" name="fecha_nacimiento" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Fecha de Nacimiento" required>
            </div>
            <div class="mb-4">
                <select name="nacionalidad" class="form-control bg-gray-700 text-white border-none p-2 w-full" required>
                    <option value="" disabled selected>Nacionalidad</option>
                    <option value="panamena">Panameña</option>
                    <option value="dominicana">Dominicana</option>
                    <option value="estadounidense">Estadounidense</option>
                    <option value="mexicana">Mexicana</option>
                    <option value="colombiana">Colombiana</option>
                    <option value="venezolana">Venezolana</option>
                    <option value="argentina">Argentina</option>
                    <option value="chilena">Chilena</option>
                    <option value="peruana">Peruana</option>
                    <option value="brasilena">Brasileña</option>
                </select>
            </div>
            <div class="mb-4">
                <input type="text" name="telefono" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Teléfono" required>
            </div>
            <div class="mb-4">
                <input type="text" name="residencia" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Residencia" required>
            </div>
            <div class="mb-4">
                <input type="email" name="email" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Correo Electrónico" required>
            </div>
            <button type="submit" class="btn bg-gray-700 text-white border-none p-2 w-full">Enviar</button>
        </form>
        <div class="mt-4">
            <a id="csv" class="btn bg-green-700 text-white border-none p-2 w-full text-center">Descargar Informe CSV</a>
        </div>
    </div>
</body>
</html>

<?php
require 'database.php';
include 'csv.php';

function validateInput($data) {
    $errors = [];

    // Validate cedula
    if (!preg_match('/^[A-Za-z0-9]{1,2}[0-9]{10}$/', $data['cedula'])) {
        $errors[] = 'Cédula inválida';
    }

    // Validate nombre
    if (strlen($data['nombre']) > 50) {
        $errors[] = 'Nombre demasiado largo';
    }

    // Validate apellido
    if (strlen($data['apellido']) > 50) {
        $errors[] = 'Apellido demasiado largo';
    }

    // Validate estado_civil
    $valid_estado_civil = ['soltero', 'casado', 'divorciado', 'viudo'];
    if (!in_array($data['estado_civil'], $valid_estado_civil)) {
        $errors[] = 'Estado civil inválido';
    }

    // Validate genero
    $valid_genero = ['masculino', 'femenino'];
    if (!in_array($data['genero'], $valid_genero)) {
        $errors[] = 'Género inválido';
    }

    // Validate tipo_sangre
    $valid_tipo_sangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    if (!in_array($data['tipo_sangre'], $valid_tipo_sangre)) {
        $errors[] = 'Tipo de sangre inválido';
    }

    // Validate fecha_nacimiento
    if (!strtotime($data['fecha_nacimiento'])) {
        $errors[] = 'Fecha de nacimiento inválida';
    }

    // Validate nacionalidad
    $valid_nacionalidad = ['panamena', 'dominicana', 'estadounidense', 'mexicana', 'colombiana', 'venezolana', 'argentina', 'chilena', 'peruana', 'brasilena'];
    if (!in_array($data['nacionalidad'], $valid_nacionalidad)) {
        $errors[] = 'Nacionalidad inválida';
    }

    // Validate telefono
    if (!preg_match('/^[0-9]{8}$/', $data['telefono'])) {
        $errors[] = 'Teléfono inválido';
    }

    // Validate residencia
    if (strlen($data['residencia']) > 150) {
        $errors[] = 'Residencia demasiado larga';
    }

    // Validate email
    if (strlen($data['email']) > 150 || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Correo electrónico inválido';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validateInput($_POST); // Validar los datos enviados por el formulario
    if (!empty($errors)) { // Verificar si hay errores
        foreach ($errors as $error) { // Recorrer los errores
            echo "<p>$error</p>"; // Mostrar los errores
        }
    } else {
        echo "<p>Formulario enviado correctamente</p>"; // Mensaje de éxito
        if (!empty($_POST['cedula']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['estado_civil']) && !empty($_POST['genero']) && !empty($_POST['tipo_sangre']) && !empty($_POST['fecha_nacimiento']) && !empty($_POST['nacionalidad']) && !empty($_POST['telefono']) && !empty($_POST['residencia']) && !empty($_POST['email'])) { // Verificar si los campos no están vacíos
            $sql = "INSERT INTO candidatos (cedula, nombre, apellido, estado_civil, genero, tipo_sangre, fecha_nacimiento, nacionalidad, telefono, residencia, email) VALUES (:cedula, :nombre, :apellido, :estado_civil, :genero, :tipo_sangre, :fecha_nacimiento, :nacionalidad, :telefono, :residencia, :email)"; 
            $stmt = $conn->prepare($sql); 
            $stmt->bindParam(':cedula', $_POST['cedula']); 
            $stmt->bindParam(':nombre', $_POST['nombre']); 
            $stmt->bindParam(':apellido', $_POST['apellido']); 
            $stmt->bindParam(':estado_civil', $_POST['estado_civil']);
            $stmt->bindParam(':genero', $_POST['genero']);
            $stmt->bindParam(':tipo_sangre', $_POST['tipo_sangre']);
            $stmt->bindParam(':fecha_nacimiento', $_POST['fecha_nacimiento']);
            $stmt->bindParam(':nacionalidad', $_POST['nacionalidad']);
            $stmt->bindParam(':telefono', $_POST['telefono']);
            $stmt->bindParam(':residencia', $_POST['residencia']);
            $stmt->bindParam(':email', $_POST['email']);
        
            if ($stmt->execute()) { // Ejecutar la consulta
                $message = 'Candidato creado exitosamente'; // Mensaje de éxito
            } else {
                $message = 'Lo siento, hubo un problema al crear el candidato';
            }
        }
    }
}

if (isset($_POST['cerrarS'])) {
    closeSession();
}

function closeSession() {
    session_start();
    session_destroy();
    header('Location: index.php');
    exit();
}

?>
