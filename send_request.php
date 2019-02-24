<?php

require_once 'include/groups.php';
require_once 'include/authentication.php';
require_once 'include/database.php';

$redirect = "Location: student_account.php";


if (isset($_POST['send_req'])) {
    $group_id = $DB->escape_string($_POST['send_req']);
    $user_id = $DB->escape_string(get_user_id());
    $result = \groups\try_send_request($group_id, $user_id);
    if ($result == 0) {
        // нет группы с таким id
        $redirect .= '?gr_error';
    } else if ($result == 2) {
        // user уже отправил запрос, больше низя
        $redirect .= '?req_error';
    } else {
        $redirect .= '?success';
    }
}

header($redirect);
exit;
