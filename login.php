<?php

require_once 'include/database.php';
require_once 'include/authentication.php';


$redirect = "Location: index.php";

if (isset($_POST['login']) && $_POST['password']) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (!try_login($login, $password)) {
        $redirect .= '?failed';
    }
}

$username = get_username();
$is_authorized = is_logged_in();


header($redirect);
exit;
