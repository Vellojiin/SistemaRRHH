<?php
session_start(); // Iniciar la sesión
require_once 'database.php';
require 'utils.php';

$nombre_usuario = $_POST['username'] ?? '';
$nombre_usuario_sanitizado = preg_replace(INVALID_USERNAME_PATTERN, '', $nombre_usuario);
$contrasena = $_POST['password'] ?? '';
$message = '';

// Validar que el nombre de usuario no contenga caracteres raros :p `sqlinjection`
if ((empty($nombre_usuario) or empty($contrasena))) {
    $message = '';
} else if (!isValidUsername($nombre_usuario)) {
    $message = 'Los datos ingresados son invalidos!';
} else {
    $conn = Database::Conectar();

    // TOOD: Renombrar `ultima_conexion` a `fecha_proxima_conexion`
    $records = $conn->prepare('SELECT id, nombre_usuario, contrasena, intentos_login, ultima_conexion FROM usuarios WHERE nombre_usuario = :nombre_usuario'); //Preparar la consulta

    $records->bindParam(':nombre_usuario', $nombre_usuario_sanitizado); //Asignar valores a los parametros
    $records->execute(); //Ejecutar la consulta
    $results = $records->fetch(PDO::FETCH_ASSOC); //Obtener los resultados
    $message = ''; //Variable para almacenar mensajes
    if (count($results) == 0) {
        $message = "No existe ningun usuario";
    } else {
        $intentos_login = $results['intentos_login']; //guarda el numero de intentos
        $ultima_conexion = strtotime($results['ultima_conexion']); // Convierte el timestamp de la última conexión a formato Unix

        // Definir el tiempo de espera en segundos (por ejemplo, 15 minutos = 900 segundos)
        $tiempo_espera = 900; // 15 minutos
        $hora_actual = time(); // Hora actual en timestamp
        $tiempo_restante = 0; // Tiempo restante para volver a intentar

        // Si el número de intentos ha alcanzado el máximo permitido
        if ($intentos_login >= MAX_NUMBER_OF_TRIES) {
            // Calcular el tiempo restante para volver a intentar
            $tiempo_restante = ($ultima_conexion + $tiempo_espera) - $hora_actual;

            // Si el tiempo restante es mayor que cero, significa que aún no puede volver a intentar
            if ($tiempo_restante > 0) {
                $minutos_restantes = floor($tiempo_restante / 60);
                $segundos_restantes = $tiempo_restante % 60;
                $message = "Vuelve a intentarlo en $minutos_restantes minutos y $segundos_restantes segundos.";
            } else {
                // Si el tiempo de espera ha pasado, restablecer los intentos de login
                $intentos_login = 0;
                $stmt = $conn->prepare('UPDATE usuarios SET intentos_login = :intentos_login WHERE nombre_usuario = :nombre_usuario');
                $stmt->bindParam(':intentos_login', $intentos_login);
                $stmt->bindParam(':nombre_usuario', $nombre_usuario_sanitizado);
                $stmt->execute();
            }
        } else {
            if (password_verify($contrasena, $results['contrasena'])) { //Verificar si el usuario existe y la contraseña es correcta
                $_SESSION['user_id'] = $results['id']; // Almacenar el id del usuario en la sesion
                header("Location: home.php"); //Redirigir a home.php
            } else {
                $message = 'Lo siento, las credenciales no coinciden';
                $intentos_login++;
                $stmt = $conn->prepare('UPDATE usuarios SET intentos_login = :intentos_login, ultima_conexion = :ultima_conexion WHERE id = :id');
                $ultima_conexion_actualizada = date('Y-m-d H:i:s', $hora_actual); // Convertir a formato de timestamp MySQL
                $stmt->bindParam(':intentos_login', $intentos_login);
                $stmt->bindParam(':ultima_conexion', $ultima_conexion_actualizada); // Actualizar la última conexión
                $stmt->bindParam(':id', $results['id']);
                $stmt->execute();
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>
            <form action="login.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium mb-2">Usuario</label>
                    <input type="text" id="username" name="username" class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium mb-2">Contraseña</label>
                    <input type="password" id="password" name="password" class="w-full p-3 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">Ingresar</button>
            </form>
            <p>
                <?php
                echo $message;
                ?>
            </p>
            <div class="text-center mt-4">
                <a href="register.php" class="text-indigo-500 hover:text-indigo-400">¿No Tienes cuenta? Registrate</a>
            </div>
        </div>
    </div>
</body>

</html>