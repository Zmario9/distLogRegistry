<?php 
require_once '../php/helper.php'; 
require_once '../php/database.php'; 
require_once '../php/registryManagement.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registerStyles.css">
    <link rel="shortcut icon" href="/img/agregar.png" type="image/png">
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <title>Register</title>
</head>

<body>
    <?php if (!empty($errors)): ?>
        <div class="error-messages" style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="container_form" method="POST">
        <h1 class="welcome-text">Crear Cuenta</h1>
        <p class="signup-prompt">¡Únete a nuestra plataforma!</p>

        <section>
            <input class="input_field" type="text" id="username" name="username" required
                value="<?php echo htmlspecialchars($username ?? ''); ?>" placeholder="Nombre de usuario">
        </section>

        <section>
            <input class="input_field email_input" type="email" id="email" name="email" required
                placeholder="Correo Electrónico">
        </section>

        <section>
            <input class="input_field password_input" type="password" id="password" name="password" required
                placeholder="Contraseña">
        </section>

        <section>
            <input class="input_field password_input confirm_password_input" type="password" id="confirm_password" name="confirm_password" required
                placeholder="Confirmar Contraseña">
        </section>

        <button class="submit_button" type="submit">Registrar</button>

        <p class="register">¿Ya tienes cuenta? <a class="register__link" href="login.php">Iniciar Sesión</a></p>
    </form>
</body>

</html>