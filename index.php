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
                    </a>
                </li>
                <li class="mr-6">
                    <a href="register.php" class="text-xl text-white">Registrarse</a>
                </li>
    </nav>
    <div class="container mx-auto p-4">
    <form>
        <div class="mb-4">
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Cédula o Pasaporte" disabled>
        </div>
        <div class="mb-4">
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Nombre" disabled>
        </div>
        <div class="mb-4">
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Apellido" disabled>
        </div>
        <div class="mb-4">
            <select class="form-control bg-gray-700 text-white border-none p-2 w-full" >
                <option value="" disabled selected>Estado Civil</option>
                <option value="soltero" disabled>Soltero</option>
                <option value="casado" disabled>Casado</option>
                <option value="divorciado" disabled>Divorciado</option>
                <option value="viudo" disabled>Viudo</option>
            </select>
        </div>
        <div class="mb-4">
            <select class="form-control bg-gray-700 text-white border-none p-2 w-full" >
                <option value="" disabled selected>Genero</option>
                <option value="masculino" disabled>Masculino</option>
                <option value="femenino" disabled>Femenino</option>
            </select>
        </div>
        <div class="mb-4">
            <select class="form-control bg-gray-700 text-white border-none p-2 w-full" >
                <option value="" disabled selected>Tipo de Sangre</option>
                <option value="A+" disabled>A+</option>
                <option value="A-" disabled>A-</option>
                <option value="B+" disabled>B+</option>
                <option value="B-" disabled>B-</option>
                <option value="AB+" disabled>AB+</option>
                <option value="AB-" disabled>AB-</option>
                <option value="O+" disabled>O+</option>
                <option value="O-" disabled>O-</option>
            </select>
        </div>
        <div class="mb-4">
            <input type="date" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Fecha de Nacimiento" disabled>
        </div>
        <div class="mb-4">
            <select class="form-control bg-gray-700 text-white border-none p-2 w-full">
                <option value="" disabled selected>Nacionalidad</option>
                <option value="panamena" disabled>Panameña</option>
                <option value="dominicana" disabled>Dominicana</option>
                <option value="estadounidense" disabled>Estadounidense</option>
                <option value="mexicana" disabled>Mexicana</option>
                <option value="colombiana" disabled>Colombiana</option>
                <option value="venezolana" disabled>Venezolana</option>
                <option value="argentina" disabled>Argentina</option>
                <option value="chilena" disabled>Chilena</option>
                <option value="peruana" disabled>Peruana</option>
                <option value="brasilena" disabled>Brasileña</option>
            </select>
        </div>
        <div class="mb-4">
            <input type="number" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Teléfono" disabled>
        </div>
        <div class="mb-4">
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Residencia" disabled>
        </div>
        <div class="mb-4">
            <input type="email" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Correo Electrónico" disabled>
        </div>
        <button class="btn bg-red-700 text-white border-none p-2 w-full" disabled>Debe Iniciar Sesion</button>
    </form>
    </div>
</body>
</html>

