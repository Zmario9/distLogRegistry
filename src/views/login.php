<?php
require_once '../php/helper.php'; 
require_once '../php/database.php'; 

if (is_logged_in())
    redirect('dashboard.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recolección y saneamiento de datos
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';

    // 2. Validaciones (mínimas para login)
    if (empty($username) || empty($password)) {
        $errors[] = "Por favor, introduce usuario y contraseña.";
    }

    if (empty($errors)) {
        $user_data = find_user($username);

        // 3. Verificación de usuario y contraseña
        if ($user_data && password_verify($password, $user_data['password_hash'])) {
            // Inicio de sesión exitoso
            $_SESSION['user_id'] = $user_data['username'];

            // Re-generación de ID de sesión (Buena Práctica de Seguridad)
            session_regenerate_id(true);

            redirect('dashboard.php');
        } else {
            $errors[] = "Usuario o contraseña incorrectos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <title>Login</title>
</head>

<body>
    <h1>Iniciar Sesión</h1>
    <?php if (isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
        <p style="color: green;">¡Registro exitoso! Por favor, inicia sesión.</p>
    <?php endif; ?>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'unauthorized'): ?>
        <p style="color: red;">Necesitas iniciar sesión para acceder al Dashboard.</p>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <section>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required
                value="<?php echo htmlspecialchars($username ?? ''); ?>">
        </section>
        <section>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>
        </section>
        <button type="submit">Entrar</button>
    </form>
    <p>¿No tienes cuenta? <a href="register.php">Registrarse</a></p>
</body>

</html>