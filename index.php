<?php
session_start();
$loggedIn = isset($_SESSION['user']); // Verifica si el usuario ha iniciado sesión
?>
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
                    <a href="login.php" class="text-xl text-white">Iniciar Sesion</a>
                </li>
                <li class="mr-6">
                    <a href="register.php" class="text-xl text-white">Registrarse</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mx-auto p-4">
        <form>
            <?php $disabled = $loggedIn ? '' : 'disabled'; ?>
            <div class="mb-4">
                <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Cédula o Pasaporte" <?php echo $disabled; ?>>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Nombre" <?php echo $disabled; ?>>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Apellido" <?php echo $disabled; ?>>
            </div>
            <div class="mb-4">
                <select class="form-control bg-gray-700 text-white border-none p-2 w-full" <?php echo $disabled; ?>>
                    <option value="" disabled selected>Estado Civil</option>
                    <option value="soltero">Soltero</option>
                    <option value="casado">Casado</option>
                    <option value="divorciado">Divorciado</option>
                    <option value="viudo">Viudo</option>
                </select>
            </div>
            <div class="mb-4">
                <select class="form-control bg-gray-700 text-white border-none p-2 w-full" <?php echo $disabled; ?>>
                    <option value="" disabled selected>Genero</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
            </div>
            <div class="mb-4">
                <select class="form-control bg-gray-700 text-white border-none p-2 w-full" <?php echo $disabled; ?>>
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
                <input type="date" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Fecha de Nacimiento" <?php echo $disabled; ?>>
            </div>
            <div class="mb-4">
                <select class="form-control bg-gray-700 text-white border-none p-2 w-full" <?php echo $disabled; ?>>
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
                <input type="number" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Teléfono" <?php echo $disabled; ?>>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Residencia" <?php echo $disabled; ?>>
            </div>
            <div class="mb-4">
                <input type="email" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Correo Electrónico" <?php echo $disabled; ?>>
            </div>
            <button class="btn bg-red-700 text-white border-none p-2 w-full" <?php echo $disabled; ?>>Debe Iniciar Sesion</button>
        </form>
    </div>
</body>
</html>

