<?php
// app/index.php

$db_host = 'mariadb'; // El nombre del servicio en docker-compose
$db_user = getenv('MYSQL_USER');
$db_pass = getenv('MYSQL_PASSWORD');
$db_name = getenv('MYSQL_DATABASE');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pila LEMP Funcionando</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; color: #333; margin: 0; padding: 40px; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 10px; margin-bottom: 20px; }
        .status { padding: 15px; border-radius: 8px; margin-bottom: 15px; font-weight: bold; }
        .success { background-color: #e8f8f5; border: 1px solid #1abc9c; color: #1abc9c; }
        .error { background-color: #fdedec; border: 1px solid #e74c3c; color: #e74c3c; }
        pre { background: #ecf0f1; padding: 15px; border-radius: 8px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Felicidades! Pila LEMP Activa</h1>

        <div class="status success">
            ✅ Nginx y PHP-FPM se están comunicando correctamente.
        </div>

        <h2>Prueba de Conexión a MariaDB</h2>

        <?php
        try {
            // Intenta conectar a MariaDB usando PDO
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo '<div class="status success">✅ Conexión a la base de datos MariaDB exitosa.</div>';

            // Prueba de lectura (opcional, para demostrar la conexión)
            // $stmt = $pdo->query('SELECT 1');
            // $result = $stmt->fetchColumn();

        } catch (PDOException $e) {
            echo '<div class="status error">❌ Error de conexión a la base de datos: ' . htmlspecialchars($e->getMessage()) . '</div>';
            echo '<p>Asegúrate de que los valores en tu archivo <code>.env</code> sean correctos y que el servicio <code>mariadb</code> esté completamente iniciado.</p>';
        }

        ?>

        <h2>Variables de Entorno (de PHP)</h2>
        <pre><?php print_r(getenv()); ?></pre>

        <h2>Información de PHP</h2>
        <p>Puedes descomentar temporalmente <code>phpinfo();</code> en el código para ver todos los detalles de la configuración de PHP.</p>
        <?php
            // phpinfo(); // Descomenta esta línea para ver la información completa de PHP
        ?>
    </div>
</body>
</html>
