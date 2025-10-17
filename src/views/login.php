<?php
require_once '../php/helper.php';
require_once '../php/database.php';

if (is_logged_in())
    redirect('dashboard.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recolección y saneamiento de datos
    // Usar FILTER_SANITIZE_FULL_SPECIAL_CHARS para mayor seguridad
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
            $_SESSION['user_id'] = $user_data['email'];

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
    <!-- Asumo que este es el archivo CSS que proporcionaste para la edición -->
    <link rel="stylesheet" href="../styles/LoginStyles/loginStyles.css">
    <link rel="icon" type="image/png" href="../img/iniciar-sesion.png">
    <title>Login</title>
</head>

<body>
    <?php if (isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
        <p class="successful_registration" style="color: green;">¡Registro exitoso! Por favor, inicia sesión.</p>
    <?php endif; ?>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'unauthorized'): ?>
        <p class="registration_unsuccessful" style="color: red;">Necesitas iniciar sesión para acceder al Dashboard.</p>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <!-- AÑADIDO: Clase 'validation-errors' y eliminado el estilo inline -->
        <div class="validation-errors" role="alert">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>
                        <?php echo htmlspecialchars($error); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="container_form" method="POST">
        <img class="app-icon" src="../img/iniciar-sesion.png" alt="">
        <h1 class="welcome-text">Welcome Back</h1>
        <p class="register">¿No tienes cuenta? <a class="register__link" href="register.php">Registrarse</a></p>
        <section>
            <input class="username_input" type="text" id="username" name="username" required
                value="<?php echo htmlspecialchars($username ?? ''); ?>" placeholder="Email">
        </section>
        <section>
            <input class="password_input" type="password" id="password" name="password" required
                placeholder="Password"><br><br>
        </section>
        <button class="submit_button" type="submit">Entrar</button>
    </form>
</body>

</html>