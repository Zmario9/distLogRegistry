<?php
require_once '../php/helper.php';
require_once '../php/database.php';

// Llama a la función para proteger la ruta
require_login();
// OBTENER datos del usuario usando el email guardado en la sesión
$user_email = $_SESSION['user_id'];
$user_data = find_user($user_email);

// Usar el nickname, si no se encuentra (fallback al email)
$display_name = $user_data['nickname'] ?? $user_email;
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
    <h1>Bienvenido al Dashboard, <?php echo htmlspecialchars($display_name); ?>!</h1>
    <p>Esta es una página protegida por sesión.</p>
    <p><a href="logoff.php">Cerrar Sesión</a></p>
</body>

</html>