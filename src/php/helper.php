<?php
session_start();
function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

function redirect($location)
{
    header("Location: " . $location);
    exit;
}

function require_login()
{
    if (!is_logged_in()) {
        redirect('../views/login.php');
    }
}