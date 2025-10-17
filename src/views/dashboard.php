<?php
require_once '../php/helper.php';

// Llama a la función para proteger la ruta
require_login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <title>Dashboard</title>
</head>

<body>
    <h1>Bienvenido al Dashboard, <?php echo htmlspecialchars($_SESSION['user_id']); ?>!</h1>
    <p>Esta es una página protegida por sesión.</p>
    <p><a href="logoff.php">Cerrar Sesión</a></p>
</body>

</html>