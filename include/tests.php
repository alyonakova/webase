<?php

namespace tests {
    require_once 'database.php';
    require_once 'groups.php';

    const DEFAULT_MAX_ATTEMPTS_PER_TEST = 3;

    function get_all() {
        global $DB;
        $query = $DB->query("SELECT id, ordinal FROM Test");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    function get_test_info($id) {
        global $DB;
        $query = $DB->query("SELECT * FROM Test WHERE id = $id");
        return $query->fetch_assoc();
    }

    function get_test_questions($id, $is_training = false) {
        global $DB;
        $test = $DB->query("SELECT * FROM Test WHERE id = $id")->fetch_assoc();

        $all_questions = $DB
            ->query("SELECT * FROM Question WHERE test_id = $id ORDER BY id")
            ->fetch_all(MYSQLI_ASSOC);

        $questions = [];
        for ($i = 1; $i <= $test['num_questions']; $i++) {
            $relevant_questions = array_filter($all_questions, function ($q) use ($i) {
                return $q['ordinal'] == $i;
            });
            if (!empty($relevant_questions)) {
                if ($is_training) {
                    $question = array_shift($relevant_questions);
                } else {
                    $question = $relevant_questions[array_rand($relevant_questions)];
                }
                array_push($questions, $question);
            }
        }
        return $questions;
    }

    function get_last_done_test_ordinal($user_id) {
        global $DB;
        $last_test = $DB->query("
            SELECT Test.ordinal
            FROM Test_Student CROSS JOIN Test 
              ON Test_Student.test_id = Test.id
            WHERE user_id = '$user_id' 
            ORDER BY Test.ordinal DESC
            LIMIT 1"
        )->fetch_assoc();
        if ($last_test == null) return 0;
        return $last_test['ordinal'];
    }

    function get_correct_answer($question_id) {
        global $DB;
        $query = $DB->query("SELECT correct_answer FROM Question WHERE id = $question_id");
        return $query->fetch_assoc()['correct_answer'];
    }

    function set_possible_attempts($test_id, $teacher_id, $attempt) {
        global $DB;
        return $DB->query("
            INSERT INTO Test_Teacher 
              SET test_id = '$test_id',
                  teacher_id = '$teacher_id',
                  possib_num_attempt = '$attempt'
            ON DUPLICATE KEY 
              UPDATE possib_num_attempt = '$attempt'");
    }

    function get_max_possible_attempts($test_id, $teacher_id) {
        global $DB;
        $query = $DB->query("SELECT possib_num_attempt FROM Test_Teacher WHERE test_id = '$test_id' AND teacher_id = '$teacher_id'");
        if ($query->num_rows == 0) return DEFAULT_MAX_ATTEMPTS_PER_TEST;
        return $query->fetch_assoc()['possib_num_attempt'];
    }

    function append_user_attempt($test_id, $user_id, $points, $attempt, $mark) {
        global $DB;
        $query = $DB->query("
            SELECT * FROM Test_Student 
            WHERE test_id='$test_id' 
              AND user_id='$user_id'");

        if ($query->num_rows > 0) {
            $DB->query("
              UPDATE Test_Student 
              SET points = '$points',
                  attempt = '$attempt', 
                  mark = '$mark', 
                  date = NOW() 
              WHERE test_id = '$test_id' 
                AND user_id = '$user_id'");
        } else {
            $DB->query("
              INSERT INTO Test_Student(
                  test_id, user_id, points, attempt, mark, `date`
              ) VALUES(
                  '$test_id', '$user_id', '$points', '$attempt', '$mark', NOW()
              )");
        }
    }

    function get_used_attempts($test_id, $user_id) {
        global $DB;
        $query = $DB->query("
            SELECT attempt 
            FROM Test_Student 
            WHERE test_id = '$test_id' 
              AND user_id = '$user_id'");
        return intval($query->fetch_assoc()['attempt']);
    }

    function can_do_test($possible_attempts, $user_attempts) {
        return ($user_attempts < $possible_attempts);
    }

    function can_user_do_test($user_id, $test_id) {
        $possible_attempts = get_max_possible_attempts($test_id, get_teacher_id_by_student($user_id));
        $used_attempts = get_used_attempts($test_id, $user_id);
        return $used_attempts < $possible_attempts;
    }

    function get_teacher_id_by_student($student_id) {
        $group_id = \groups\get_student_group_id($student_id);
        return \groups\get_teacher_id_by_group($group_id);
    }
}
