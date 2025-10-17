<?php
//Simulamos la existencia de una BD usando la sesión de la app
//Esto significa que cuando se cierre el navegador, los datos se perderan
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}
$users = &$_SESSION['users'];

function register_user($username, $password) {
    global $users;
    
    // Si el usuario ya existe, no permite el registro.
    if (isset($users[$username])) {
        return false;
    }

    // Usar password_hash para hashear la contraseña
    $users[$username] = [
        'username' => $username,
        // Usamos PASSWORD_BCRYPT por seguridad. El resultado debe almacenarse
        // en una columna de al menos 60 caracteres (si fuera BD).
        'password_hash' => password_hash($password, PASSWORD_BCRYPT), 
    ];
    return true;
}

function find_user($username) {
    global $users;
    return $users[$username] ?? null;
}