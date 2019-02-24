<?php

require_once 'include/authentication.php';

logout();
header("Location: index.php");
exit;
