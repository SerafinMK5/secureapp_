<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Test</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }
    input, button {
      display: block;
      width: 100%;
      padding: 10px;
      margin-top: 10px;
    }
    #response {
      margin-top: 20px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h2>Login</h2>
  <form id="loginForm">
    <input type="text" id="username" placeholder="Usuario" required />
    <input type="password" id="password" placeholder="Contraseña" required />
    <button type="submit">Iniciar sesión</button>
  </form>

  <div id="response"></div>

  <script>
    const form = document.getElementById('loginForm');
    const responseDiv = document.getElementById('response');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value;

      try {
        const res = await fetch('http://192.168.1.124:3000/auth/login.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ username, password })
        });

        const data = await res.json();

        if (res.ok) {
          responseDiv.style.color = 'green';
          responseDiv.textContent = data.message;
        } else {
          responseDiv.style.color = 'red';
          responseDiv.textContent = data.error || data.message;
        }
      } catch (error) {
        responseDiv.style.color = 'red';
        responseDiv.textContent = 'Error de conexión con el servidor.';
      }
    });
  </script>
</body>
</html>
