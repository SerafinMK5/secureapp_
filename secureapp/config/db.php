<?php
require_once __DIR__ . '/load_env.php'; // asegúrate que esto se cargue primero

$host = get_config('DB_HOST', 'localhost');
$port = get_config('DB_PORT', '29358'); // puerto por defecto si no se define
$db   = get_config('DB_NAME', 'secure_app');
$user = get_config('DB_USER', 'root');
$pass = get_config('DB_PASS', '');

try {
    // ✅ Incluir el puerto explícitamente
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die("❌ Error de conexión a la base de datos: " . $e->getMessage());
}
