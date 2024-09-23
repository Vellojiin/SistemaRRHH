<?php
// Incluir la clase de conexión
require_once 'Database.php';

// Conectar a la base de datos
$pdo = Database::Conectar();

if ($pdo) {
    // Recibir los datos del formulario
    $nombre_usuario = $_POST['username'];
    $correo = $_POST['email'];
    $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña

    // Preparar la consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena) VALUES (:nombre_usuario, :correo, :contrasena)";
    $stmt = $pdo->prepare($sql);

    // Asignar valores a los parámetros
    $stmt->bindParam(':nombre_usuario', $nombre_usuario);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':contrasena', $contrasena);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: home.php');
    } else {
        echo "Error en el registro. Intenta de nuevo.";
    }
} else {
    echo "Error al conectar a la base de datos.";
}

// Cerrar la conexión (opcional, ya que PDO se cierra automáticamente al final del script)
$pdo = null;
?>
