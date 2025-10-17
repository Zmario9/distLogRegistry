<?php
require_once 'database.php';
require_once 'helper.php'; // Incluimos helpers para usar redirect()

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recolección y saneamiento de datos
    $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = $_POST['password'] ?? ''; // La contraseña no se sanea ya que será hasheada
    $confirm_password = $_POST['confirm_password'] ?? '';

    // 2. Validaciones del lado del servidor

    if (empty($nickname) || empty($password) || empty($confirm_password) || empty($email)) {
        $errors[] = "Todos los campos son obligatorios.";
    }

    if (strlen($nickname) < 3 || strlen($nickname) > 50) {
        $errors[] = "El nombre de usuario debe tener entre 3 y 50 caracteres.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    if (strlen($password) < 6) {
        $errors[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (find_user_by_nickname($nickname)) {
        $errors[] = "El nombre de usuario (nickname) ya está en uso.";
    }

    if (find_user($email)) {
        $errors[] = "El email del usuario ya está en uso.";
    }

    // 3. Procesar si no hay errores
    if (empty($errors)) {
        if (register_user($email,$nickname, $password)) {
            // Registro exitoso, redirigir al login
            redirect('../views/login.php?success=registered');
            exit;
            // redirect('../views/login.php?success=registered');
        } else {
            // Este caso ya está cubierto por el `find_user` pero es un buen fallback
            $errors[] = "Error al intentar registrar el usuario.";
        }
    }
    //MANTIENE LOS VALORES EN LOS CAMPOS
    $nickname = $_POST['nickname'] ?? '';
    $email = $_POST['email'] ?? '';
}