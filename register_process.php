<?php
// Incluir la clase de conexión
require_once 'Database.php';
require 'utils.php';

// Conectar a la base de datos
$pdo = Database::Conectar();
$nombre_usuario = $_POST['username'];
$nombre_usuario_sanitizado = preg_replace(INVALID_USERNAME_PATTERN, '', $nombre_usuario);
$correo = $_POST['email'];
$contrasena = $_POST['password'];

if ((empty($nombre_usuario) or empty($correo)) or !isValidUsername($nombre_usuario)) {
    echo json_encode(["error" =>  "el nombre de usuario o  el correo son invalidos, revisalos e intentalo nuevamente!"]);
} else if (!isValidPassword($contrasena)) {
    echo json_encode(["error" =>  "La contraseña debe tener 8 carácteres mínimo, combinación de números, letras y carácteres especiales."]);
} else if (!$pdo) {
    echo json_encode(["error" => "Error al conectar a la base de datos."]);
} else {

    // Recibir los datos del formulario
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
        $stmt->bindParam(':nombre_usuario', $nombre_usuario_sanitizado);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(["success" => "Registro exitoso. Puedes iniciar sesión."]);
        } else {
            echo json_encode(["error" => "Error en el registro. Intenta de nuevo."]);
        }
    }
}

// Cerrar la conexión (opcional, ya que PDO se cierra automáticamente al final del script)
$pdo = null;
