<?php
// Incluir la clase de conexión
require_once 'Database.php';
require 'utils.php';
// Conectar a la base de datos
$pdo = Database::Conectar();

if ($pdo) {
    // Recibir los datos del formulario
    $nombre_usuario = $_POST['username'];
    $correo = $_POST['email'];
    $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña

    // Verificar si el nombre de usuario ya existe
    $checkUsername = "SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario";
    $stmtUsername = $pdo->prepare($checkUsername);
    $stmtUsername->bindParam(':nombre_usuario', $nombre_usuario);
    $stmtUsername->execute();
    $existingUser = $stmtUsername->fetch(PDO::FETCH_ASSOC);

    // Verificar si el correo ya existe
    $checkEmail = "SELECT * FROM usuarios WHERE correo = :correo";
    $stmtEmail = $pdo->prepare($checkEmail);
    $stmtEmail->bindParam(':correo', $correo);
    $stmtEmail->execute();
    $existingEmail = $stmtEmail->fetch(PDO::FETCH_ASSOC);

    // Verificar si el nombre de usuario o el correo ya existen
    if ($existingUser) {
        echo json_encode(["error" => "El nombre de usuario ya está registrado."]);
        exit();
    } elseif ($existingEmail) {
        echo json_encode(["error" => "El correo electrónico ya está registrado."]);
        exit();
    } else {
        // Si no existen, proceder a registrar el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre_usuario, correo, contrasena) VALUES (:nombre_usuario, :correo, :contrasena)";
        $stmt = $pdo->prepare($sql);

        // Asignar valores a los parámetros
        $stmt->bindParam(':nombre_usuario', $nombre_usuario);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(["success" => "Registro exitoso. Puedes iniciar sesión."]);
        } else {
            echo json_encode(["error" => "Error en el registro. Intenta de nuevo."]);
        }
    }
} else {
    echo json_encode(["error" => "Error al conectar a la base de datos."]);
}

// Cerrar la conexión (opcional, ya que PDO se cierra automáticamente al final del script)
$pdo = null;
?>

