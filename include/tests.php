<?php

namespace tests {
    require_once 'database.php';

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
            if ($is_training) {
                $question = array_shift($relevant_questions);
            } else {
                $question = $relevant_questions[array_rand($relevant_questions)];
            }
            array_push($questions, $question);
        }
        return $questions;
    }

    function get_training_test($id) {
        return get_test($id, true);
    }

    function get_last_done($user_id) {
        global $DB;
        $query = $DB->query("SELECT * FROM Test_Student WHERE user_id = '$user_id'");
        //
        //
    }

    function get_correct_answer($question_id) {
        global $DB;
        $query = $DB->query("SELECT correct_answer FROM Question WHERE id = $question_id");
        return $query->fetch_assoc()['correct_answer'];
    }
}
