<?php

require_once 'include/authentication.php';
require_once 'include/groups.php';

$redirect = "Location: student_account.php";

$user_id = get_user_id();
$user_id = $DB->escape_string($user_id);

\groups\leave_student_group($user_id);

header($redirect);
exit;
