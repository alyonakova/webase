<?php

namespace groups {
    require_once 'database.php';

    function create($name, $teacher_id) {
        global $DB;
        if ($name != null) {
            $query = $DB->query("INSERT INTO `Groups`(name, teacher_id) VALUES('$name', '$teacher_id')");
        }
    }

    function has_groups($teacher_id) {
        global $DB;
        $query = $DB->query("SELECT * FROM `Groups` WHERE teacher_id = '$teacher_id'");
        return $query->num_rows > 0;
    }

    function by_teacher($teacher_id) {
        global $DB;
        $query = $DB->query("SELECT * FROM `Groups` WHERE teacher_id = '$teacher_id'");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    function student_has_group($user_id) {
        global $DB;
        $query = $DB->query("SELECT group_id FROM Users WHERE id = '$user_id'");
        return $query->fetch_assoc()['group_id'] != null;
    }

    function get_student_group_id($user_id) {
        global $DB;
        $query = $DB->query("SELECT group_id FROM Users WHERE id = '$user_id'");
        return $query->fetch_assoc()['group_id'];
    }

    function get_student_group_name($user_id) {
        global $DB;
        $query = $DB->query(
            "SELECT `Groups`.name
                FROM Users JOIN `Groups`
                ON Users.group_id = `Groups`.id
                WHERE Users.id = '$user_id'"
        );
        return $query->fetch_assoc()['name'];
    }

    function leave_student_group($user_id) {
        global $DB;
        $query = $DB->query("UPDATE Users SET group_id = null WHERE id = '$user_id'");
    }

    function get_students_in_group($group_id) {
        global $DB;
        $query = $DB->query("SELECT * FROM Users WHERE group_id = '$group_id' ORDER BY surname, name, second_name");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    function can_find_group_by_id($group_id) {
        global $DB;
        $query = $DB->query("SELECT * FROM `Groups` WHERE id = '$group_id'");
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function has_user_request($user_id) {
        global $DB;
        $query = $DB->query("SELECT * FROM Request WHERE user_id = '$user_id'");
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function try_send_request($group_id, $user_id) {
        global $DB;
        if(can_find_group_by_id($group_id)) {
            if (!has_user_request($user_id)) {
                $query = $DB->query("INSERT INTO Request(group_id, user_id) VALUES('$group_id', '$user_id')");
                return 1;
            } else {
                return 2;
            }
        } else {
            return 0;
        }
    }

    function get_requests_in_group($group_id) {
        global $DB;
        $query = $DB->query("SELECT * FROM Request WHERE group_id = '$group_id'");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    function add_user_to_group($user_id, $group_id) {
        global $DB;
        $query = $DB->query("UPDATE Users SET group_id = '$group_id' WHERE id = '$user_id'");
    }

    function reject_request($user_id) {
        global $DB;
        $query = $DB->query("DELETE FROM Request WHERE user_id = '$user_id'");
    }

    function get_teacher_id_by_group($group_id) {
        global $DB;
        $query = $DB->query("SELECT teacher_id FROM `Groups` WHERE id = '$group_id'");
        return $query->fetch_assoc()['teacher_id'];
    }
}

