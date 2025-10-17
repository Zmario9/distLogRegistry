<?php
// Se encarga de iniciar sesión y mantenerla mientras se navega
session_start();

// Función para verificar si el usuario está logueado
function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

// Función para redirigir a otra página
function redirect($location)
{
    header("Location: " . $location);
    exit;
}

// Función para proteger rutas que requieren autenticación
function require_login()
{
    if (!is_logged_in()) {
        redirect('../views/login.php?error=unauthorized');
    }
}