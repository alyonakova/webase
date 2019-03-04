<?php

function try_to_update() {
    global $DB;
    $id = $_SESSION['user']['id'];
    $id = $DB->escape_string($id);
    if ($_POST['login'] != null) {
        $user = find_user_by_login($_POST['login']);
        if (isset($user) && $user['id'] !== get_user_id()) {
           return false;
        } else {
           $login = $_POST['login'];
           $login = $DB->escape_string($login);
           $update_login = $DB->query("UPDATE Users SET login = '$login' WHERE id = '$id'");
           $_SESSION['user']['login'] = $login;
           $_SESSION['login'] = $login;
        }
    } else {
        $update_login = true;
    }

    if ($_POST['surname'] != null) {
        $surname = $_POST['surname'];
        $surname = $DB->escape_string($surname);
        $update_surname = $DB->query("UPDATE Users SET surname = '$surname' WHERE id = '$id'");
        $_SESSION['user']['surname'] = $surname;
    } else {
        $update_surname = true;
    }

    if ($_POST['name'] != null) {
        $name = $_POST['name'];
        $name = $DB->escape_string($name);
        $update_name = $DB->query("UPDATE Users SET name = '$name' WHERE id = '$id'");
        $_SESSION['user']['name'] = $name;
    } else {
        $update_name = true;
    }

    if ($_POST['secname'] != null) {
        $secname = $_POST['secname'];
        $secname = $DB->escape_string($secname);
        $update_secname = $DB->query("UPDATE Users SET second_name = '$secname' WHERE id = '$id'");
        $_SESSION['user']['second_name'] = $secname;
    } else {
        $update_secname = true;
    }

    if ($_POST['password'] != null) {
        $password = $_POST['password'];
        $salt = rand();
        $password = $DB->escape_string(hash_credentials($salt, $password));
        $update_password = $DB->query("UPDATE Users SET salt = '$salt', password = '$password' WHERE id = '$id'");
        $_SESSION['user']['password'] = $password;
    } else {
        $update_password = true;
    }

    //$query = $DB->query("UPDATE Users SET login = '$login', password = '$password', surname = '$surname', name = '$name', second_name = '$secname' WHERE id = '$id'");

    return true;
}
