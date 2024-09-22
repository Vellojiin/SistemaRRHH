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
                
    </nav>
    <div class="container mx-auto p-4">
        <form>
            <div class="mb-4">
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Cédula o Pasaporte" required>
            </div>
            <div class="mb-4">
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Nombre" required>
            </div>
            <div class="mb-4">
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Apellido" required>
            </div>
            <div class="mb-4">
            <select class="form-control bg-gray-700 text-white border-none p-2 w-full" >
                <option value="" disabled selected>Estado Civil</option>
                <option value="soltero">Soltero</option>
                <option value="casado">Casado</option>
                <option value="divorciado">Divorciado</option>
                <option value="viudo">Viudo</option>
            </select>
        </div>
            <div class="mb-4">
            <select class="form-control bg-gray-700 text-white border-none p-2 w-full" required>
                <option value="" disabled selected>Genero</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                
            </select>
            </div>
            <div class="mb-4">
            <select class="form-control bg-gray-700 text-white border-none p-2 w-full" required>
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
            <input type="date" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Fecha de Nacimiento" required>
            </div>
            <div class="mb-4">
            <select class="form-control bg-gray-700 text-white border-none p-2 w-full" required>
                <option value="" disabled selected>Nacionalidad</option>
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
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Teléfono" required>
            </div>
            <div class="mb-4">
            <input type="text" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Residencia" required>
            </div>
            <div class="mb-4">
            <input type="email" class="form-control bg-gray-700 text-white border-none p-2 w-full" placeholder="Correo Electrónico" required>
            </div>
            <button type="submit" class="btn bg-gray-700 text-white border-none p-2 w-full">Enviar</button>
        </form>
        <div class="mt-4">
            <a href="download_report.php" class="btn bg-green-700 text-white border-none p-2 w-full text-center">Descargar Informe CSV</a>
        </div>
    </div>
</body>
</html>

<?php

require 'database.php';
