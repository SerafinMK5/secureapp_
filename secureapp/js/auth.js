const API_BASE = 'https://webbasic.onrender.com'; // Ajusta esto si tu backend está en otra ruta

// LOGIN
const loginForm = document.getElementById('loginForm');
if (loginForm) {
  loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(loginForm);
    const data = Object.fromEntries(formData.entries());
    try {
      const res = await fetch(`${API_BASE}/auth/login.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });
      const result = await res.json();
      if (res.ok && result.token) {
        localStorage.setItem('jwt', result.token);
        alert('Login exitoso');
        window.location.href = 'dashboard.html';
      } else {
        alert(result.message || 'Error al iniciar sesión');
      }
    } catch (err) {
      console.error(err);
      alert('Fallo en la conexión con el servidor');
    }
  });
}

// REGISTRO
const registerForm = document.getElementById('registerForm');
if (registerForm) {
  registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(registerForm);
    const data = Object.fromEntries(formData.entries());
    try {
      const res = await fetch(`${API_BASE}/auth/register.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });
      const result = await res.json();
      if (res.ok && result.message) {
        alert('Registro exitoso');
        registerForm.reset();
      } else {
        alert(result.message || 'Error en el registro');
      }
    } catch (err) {
      console.error(err);
      alert('Fallo en la conexión con el servidor');
    }
  });
}
