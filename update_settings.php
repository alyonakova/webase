<?php

require_once 'include/database.php';
require_once 'include/authentication.php';
require_once 'include/registration.php';
require_once 'include/update.php';

$redirect = "Location: settings.php";

if (try_to_update()) {
    $redirect = 'Location: index.php';
} else {
    $redirect .= '?failed';
}

header($redirect);
exit;
