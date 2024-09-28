<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Registro</h2>
            <form id="registerForm">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium">Usuario</label>
                    <input type="text" id="username" name="username" class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium">Contraseña</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div id="message" class="mb-4 text-red-500 text-sm text-center"></div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrar</button>
                </div>
            </form>
            <div class="text-center mt-4">
                <a href="login.php" class="text-indigo-500 hover:text-indigo-400">¿Ya tienes cuenta? Iniciar sesión</a>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Evitar que el formulario se envíe de la forma tradicional

            const formData = new FormData(this);
            fetch('register_process.php', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    const messageDiv = document.getElementById('message');
                    if (data.error) {
                        messageDiv.textContent = data.error; // Mostrar el mensaje de error
                    } else if (data.success) {
                        messageDiv.textContent = data.success; // Mostrar mensaje de éxito
                        // Puedes redirigir o limpiar el formulario aquí si lo deseas
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>