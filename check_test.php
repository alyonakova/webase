<?php

require_once 'include/tests.php';

$test_id = $_POST['test_id'];
$test = \tests\get_test_info($test_id);

$given_answers = [];
?>

<?php for ($i = 1; $i <= $test['num_questions']; $i++) {
    $question_id = $_POST["question$i"];
    $given_answers[$i] = $_POST["answer$i"];
    $correct_answer = \tests\get_correct_answer($question_id);
    if ($given_answers[$i] == $correct_answer) {
        echo "вопрос $i, ответ верный;";
    } else {
        echo "вопрос $i, ответ НЕПРАВИЛЬНЫЙ;";
    }
}
