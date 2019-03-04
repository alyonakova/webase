<?php

require_once 'database.php';

session_start();

function find_user($login, $password) {
    global $DB;
    $login = $DB->escape_string($login);
    $query = $DB->query("SELECT * FROM Users WHERE login LIKE '%$login%'");
    if ($query->num_rows > 0) {
        $user = $query->fetch_assoc();
        if (hash_credentials($user['salt'], $password) == $user['password']) {
            return $user;
        }
    }
    return null;
}

function try_login($login, $password) {
    session_start();
    $user = find_user($login, $password);
    if (isset($user)) {
        $_SESSION['login'] = $login;
        $_SESSION['user'] = $user;
        return true;
    } else {
        unset($_SESSION['login']);
        unset($_SESSION['user']);
        return false;
    }
}

function logout() {
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['user']);
}

function is_logged_in() {
    return !empty(session_id()) && !empty($_SESSION['login']);
}

function get_username() {
    return $_SESSION['user']['name'];
}

function get_user_id() {
    return $_SESSION['user']['id'];
}

function get_user_by_id($user_id) {
    global $DB;
    $query = $DB->query("SELECT * FROM Users WHERE id = '$user_id'");
    return $query->fetch_all(MYSQLI_ASSOC);
}
