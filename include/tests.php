<?php

function get_last_done($user_id) {
    global $DB;
    $query = $DB->query("SELECT * FROM Test_Student WHERE user_id = '$user_id'");
    //
    //
}


