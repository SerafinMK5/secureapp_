<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form id="form-registro">
        <label>Nombre de Usuario:</label><br>
        <input type="text" id="username" required><br><br>

        <label>Correo Electrónico:</label><br>
        <input type="email" id="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" id="password" required><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <p id="mensaje"></p>

    <script>
        document.getElementById('form-registro').addEventListener('submit', function (e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('http://localhost:3000/auth/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ username, email, password })
            })
            .then(response => response.json())
            .then(data => {
                const mensaje = document.getElementById('mensaje');
                if (data.message) {
                    mensaje.textContent = data.message;
                    mensaje.style.color = 'green';
                } else {
                    mensaje.textContent = data.error || 'Error desconocido';
                    mensaje.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('mensaje').textContent = 'Error de red o servidor no disponible';
            });
        });
    </script>
</body>
</html>
