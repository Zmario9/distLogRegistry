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
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <title>Register</title>
</head>

<body>
    <h1>Registro de Usuario</h1>
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
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required
            value="<?php echo htmlspecialchars($username ?? ''); ?>"><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <button type="submit">Registrar</button>
    </form>
    <p>¿Ya tienes cuenta? <a href="login.php">Iniciar Sesión</a></p>
</body>

</html>