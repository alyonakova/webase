<?php

require_once 'include/database.php';
require_once 'include/authentication.php';
require_once 'include/registration.php';

$redirect = "Location: registration_page.php";

if (isset($_POST['login']) && isset($_POST['surname']) && isset($_POST['name'])
&& isset($_POST['secname']) && isset($_POST['stud_teach']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $secname = $_POST['secname'];
    $is_teacher = $_POST['stud_teach'] == 'teacher';
    $password = $_POST['password'];
    if (try_register($login, $surname, $name, $secname, $is_teacher, $password)) {
        try_login($login, $password);
        $redirect = 'Location: index.php';
    } else {
        $redirect .= '?failed';
    }
}

header($redirect);
exit;
