<?php
##Importes del login
require_once '../php/helper.php';
require_once '../php/database.php';

#Si todavía el usuario está loggeado, reedirige al dashboard, como en la mayoría de paginas web
if (is_logged_in())
    redirect('dashboard.php');

#Arreglo que guardará los errores
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recolección y saneamiento de datos
    // Filtro el input de usuario con un saneamiento completo para prevenir inyecciones peponas que provoca la desvivicion del servidor o algo peor
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //Nada que hacer con la contraseña más que obtenerla
    $password = $_POST['password'] ?? '';

    // 2. Validaciones (mínimas para login)
    if (empty($username) || empty($password)) {
        $errors[] = "Por favor, introduce usuario y contraseña.";
    }

    // 3. Procesar si no hay errores
    if (empty($errors)) {
        //Busca usuario en la "base de datos"
        $user_data = find_user($username);
        // 4. Verificación de usuario y contraseña
        if ($user_data && password_verify($password, $user_data['password_hash'])) {
            // Inicio de sesión exitoso
            $_SESSION['user_id'] = $user_data['email'];
            // Re-generación de ID de sesión (Buena Práctica de Seguridad porque creo que eso se mantiene en caché )
            session_regenerate_id(true);
            // Redirige al dashboard
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
    <!-- ESTILOS -->
    <link rel="stylesheet" href="../styles/LoginStyles/loginStyles.css">
    <link rel="icon" type="image/png" href="../img/iniciar-sesion.png">
    <title>Login</title>
</head>

<body>
    <!-- Mensajes relacionados con el exito o fracaso del registro desde registro.php-->
    <?php if (isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
        <p class="successful_registration" style="color: green;">¡Registro exitoso! Por favor, inicia sesión.</p>
    <?php endif; ?>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'unauthorized'): ?>
        <p class="registration_unsuccessful" style="color: red;">Necesitas iniciar sesión para acceder al Dashboard.</p>
    <?php endif; ?>

    <!-- Lo mismo que en registro para mostrar errores de validacion -->
    <?php if (!empty($errors)): ?>
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