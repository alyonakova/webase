<?php

require_once 'include/authentication.php';
require_once 'include/groups.php';

$redirect = "Location: teacher_account.php";

$name = $DB->escape_string($_POST['group']);
$teacher_id = get_user_id();
if ($name != null) {
    \groups\create($name, $teacher_id);
}
header($redirect);
exit;
