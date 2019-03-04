<?php

function find_user_by_login($login)
{
    global $DB;
    $login = $DB->escape_string($login);
    $query = $DB->query("SELECT * FROM Users WHERE login LIKE '$login'");
    if ($query->num_rows > 0) {
        return mysqli_fetch_assoc($query);
    } else {
        return null;
    }
}

function try_register($login, $surname, $name, $secname, $is_teacher, $password)
{
    if (!isset($login) || empty($login)) return false;
    $user = find_user_by_login($login);
    if ($user != null) return false;

    global $DB;
    $login = $DB->escape_string($login);
    $surname = $DB->escape_string($surname);
    $name = $DB->escape_string($name);
    $secname = $DB->escape_string($secname);
    $salt = rand();
    $is_teacher = $is_teacher ? "TRUE" : "FALSE";
    $password = $DB->escape_string(hash_credentials($salt, $password));
    return $DB->query("INSERT INTO Users(id, login, salt, password, surname, name, second_name, is_teacher, group_id) VALUES(null, '$login', '$salt', '$password', '$surname', '$name', '$secname', $is_teacher, null)");
}

function set_default_attempts($test_id, $teacher_id) {
    global $DB;
    $query = $DB->query("INSERT INTO Test_Teacher(test_id, teacher_id, possib_num_attempt) VALUES('$test_id', '$teacher_id', 3)");
}

