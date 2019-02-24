<?php

require_once 'include/database.php';
require_once 'include/authentication.php';
require_once 'include/groups.php';

$redirect = "Location: teacher_account.php";

$user = $_GET['user'];
\groups\reject_request($user);

header($redirect);
exit;
