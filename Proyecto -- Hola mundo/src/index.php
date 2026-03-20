<?php
/**
 * Aplicación Hola Mundo
 * Conexión a base de datos MySQL vía PDO
 */

// ─── Configuración de conexión (variables de entorno inyectadas por Docker) ───
$db_host = getenv('DB_HOST')     ?: 'mysql';
$db_name = getenv('DB_NAME')     ?: 'holaMundoDB';
$db_user = getenv('DB_USER')     ?: 'appuser';
$db_pass = getenv('DB_PASSWORD') ?: 'apppassword';

// ─── Intentar conexión a MySQL ─────────────────────────────────────────────
$conexion_ok = false;
$db_version   = '';
$error_msg    = '';

try {
    $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT            => 5,
    ]);

    // Obtener versión del servidor MySQL
    $stmt       = $pdo->query("SELECT VERSION() AS version");
    $row        = $stmt->fetch();
    $db_version = $row['version'];
    $conexion_ok = true;

} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola Mundo — PHP + MySQL + Docker</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 48px 56px;
            max-width: 560px;
            width: 100%;
            box-shadow: 0 24px 60px rgba(0,0,0,0.4);
            text-align: center;
        }

        .logo { font-size: 64px; margin-bottom: 16px; }

        h1 {
            font-size: 2.4rem;
            color: #1a1a2e;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 36px;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 28px;
        }

        .badge.success { background: #d4edda; color: #155724; }
        .badge.error   { background: #f8d7da; color: #721c24; }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 20px;
        }

        .info-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 14px;
        }

        .info-item .label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #999;
            margin-bottom: 4px;
        }

        .info-item .value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #333;
        }

        .error-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            border-radius: 8px;
            padding: 16px;
            margin-top: 24px;
            text-align: left;
            font-size: 0.85rem;
            color: #555;
            word-break: break-all;
        }

        footer {
            margin-top: 32px;
            font-size: 0.78rem;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="card">

        <div class="logo">🌍</div>
        <h1>¡Hola Mundo!</h1>
        <p class="subtitle">PHP · MySQL · Docker Compose</p>

        <?php if ($conexion_ok): ?>
            <span class="badge success">✔ Conexión exitosa a MySQL</span>

            <div class="info-grid">
                <div class="info-item">
                    <div class="label">Servidor</div>
                    <div class="value"><?= htmlspecialchars($db_host) ?></div>
                </div>
                <div class="info-item">
                    <div class="label">Base de datos</div>
                    <div class="value"><?= htmlspecialchars($db_name) ?></div>
                </div>
                <div class="info-item">
                    <div class="label">MySQL versión</div>
                    <div class="value"><?= htmlspecialchars($db_version) ?></div>
                </div>
                <div class="info-item">
                    <div class="label">PHP versión</div>
                    <div class="value"><?= PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION ?></div>
                </div>
            </div>

        <?php else: ?>
            <span class="badge error">✖ Error de conexión</span>
            <div class="error-box">
                <strong>Detalle:</strong> <?= htmlspecialchars($error_msg) ?>
            </div>
        <?php endif; ?>

        <footer>Entorno Dockerizado · <?= date('Y') ?></footer>

    </div>
</body>
</html>
