<?php
//Simulamos la existencia de una BD usando la sesión de la app
//Esto significa que cuando se cierre el navegador, los datos se perderan
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}
$users = &$_SESSION['users'];

function register_user($email, $nickname, $password) {
    global $users;
    
    // Si el usuario ya existe, no permite el registro.
    if (isset($users[$email])) {
        return false;
    }
    // Si el nickname ya existe, no permite el registro
    foreach ($users as $user_data) {
        if ($user_data['nickname'] === $nickname) {
            return false;
        }
    }

    // Usar password_hash para hashear la contraseña
    $users[$email] = [
        'nickname' => $nickname,
        'email' => $email,
        'password_hash' => password_hash($password, PASSWORD_DEFAULT), 
    ];
    return true;
}

//Función para buscar a un usuario por email
function find_user($email) {
    global $users;
    return $users[$email] ?? null;
}

//Buscarlo pero por nickname
function find_user_by_nickname($nickname) {
    global $users;
    foreach ($users as $user_data) {
        if ($user_data['nickname'] === $nickname) {
            // Retornamos los datos del usuario si encontramos el nickname
            return $user_data; 
        }
    }
    return null;
}