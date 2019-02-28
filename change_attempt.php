<?php

require_once 'include/tests.php';
require_once 'include/authentication.php';
require_once 'include/database.php';

$redirect = "Location: course.php";

$attempt = $_POST['attempt'];
$teacher_id = get_user_id();
$test_id = $_POST['test_id'];

if (\tests\set_possible_attempts($test_id, $teacher_id, $attempt)) {
    header($redirect);
    exit;
} else {
    echo "<p class='error'>Что-то пошло не так при попытке изменить число попыток.</p>";
    echo "<a href='course.php'>Вернуться</a>";
    exit;
}

