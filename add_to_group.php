<?php
require_once 'include/database.php';
require_once 'include/authentication.php';
require_once 'include/groups.php';

$redirect = "Location: teacher_account.php";

$user = $_GET['user'];
$group =  $_GET['group'];

\groups\add_user_to_group($user, $group);
\groups\reject_request($user);

header($redirect);
exit;
