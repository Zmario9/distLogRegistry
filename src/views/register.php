<?php
// Llamo a los helpers, base de datos y gestión de registro para manejar el comportamiento del form
require_once '../php/helper.php';
require_once '../php/database.php';
require_once '../php/registryManagement.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ESTILOS -->
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <link rel="stylesheet" href="../styles/RegisterStyles/registerForm.css">
    <title>Register</title>
</head>

<body>
    <!-- ENCABEZADO DEL FORM-->
    <h1>Registro de Usuario</h1>
    <!-- Si no está vacío el arreglo de errores, muestra los mensajes en un foreach -->
    <?php if (!empty($errors)): ?>
        <div class="error-messages">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <!-- FORMULARIO DE REGISTRO, con un comportamiento siilar al de login en terminos de saniteado -->
    <form class="container_form" method="POST">
        <h1 class="welcome-text">Crear Cuenta</h1>
        <p class="signup-prompt">¡Únete a nuestra plataforma!</p>
        <!-- Entradas de usuario, htmlspecialchars para evitar inyección de html-->
        <section>
            <input class="input_field" type="text" id="nickname" name="nickname" required
                value="<?php echo htmlspecialchars($nickname ?? ''); ?>" placeholder="Nombre de usuario">
        </section>
        <section>
            <input class="input_field email_input" type="email" id="email" name="email" required
                value="<?php echo htmlspecialchars($email ?? ''); ?>" placeholder="Correo Electrónico">
        </section>
        <section>
            <input class="input_field password_input" type="password" id="password" name="password" required
                placeholder="Contraseña">
        </section>
        <section>
            <input class="input_field password_input confirm_password_input" type="password" id="confirm_password"
                name="confirm_password" required placeholder="Confirmar Contraseña">
        </section>
        <button class="submit_button" type="submit">Registrar</button>

        <p class="register">¿Ya tienes cuenta? <a class="register__link" href="login.php">Iniciar Sesión</a></p>
    </form>
</body>

</html>