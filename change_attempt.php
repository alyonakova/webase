<?php

require_once 'include/tests.php';
require_once 'include/authentication.php';
require_once 'include/database.php';

$redirect = "Location: course.php";

$attempt = $_POST['attempt'];
$teacher_id = get_user_id();
$test_id = $_POST['test_id'];
\tests\change_attempt($test_id, $teacher_id, $attempt);

header($redirect);
exit;
