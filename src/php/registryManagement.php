<?php
require_once 'database.php';
require_once 'helper.php'; // Incluimos helpers para usar redirect()

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recolección y saneamiento de datos
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? ''; // La contraseña no se sanea ya que será hasheada
    $confirm_password = $_POST['confirm_password'] ?? '';

    // 2. Validaciones del lado del servidor
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $errors[] = "Todos los campos son obligatorios.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (strlen($password) < 6) {
        $errors[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (find_user($username)) {
        $errors[] = "El nombre de usuario ya está en uso.";
    }

    // 3. Procesar si no hay errores
    if (empty($errors)) {
        if (register_user($username, $password)) {
            // Registro exitoso, redirigir al login
            redirect('../views/login.php?success=registered');
            exit;
            // redirect('../views/login.php?success=registered');
        } else {
            // Este caso ya está cubierto por el `find_user` pero es un buen fallback
            $errors[] = "Error al intentar registrar el usuario.";
        }
    }
}
?>