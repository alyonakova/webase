<?php

require_once 'include/tests.php';
require_once 'header.php.inc';
require_once 'include/authentication.php';

$test_id = $_POST['test_id'];
$test = \tests\get_test_info($test_id);
$is_training = $_POST["is_training"];

$given_answers = [];
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Тестирование</title>
        <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
        <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
<body>
<main class="main">

<?php
print_header('course');
?>
    <div class="site_content">
        <?php $points = 0; ?>
        <?php for ($i = 1; $i <= $test['num_questions']; $i++) {
            $question_id = $_POST["question$i"];
            $given_answers[$i] = $_POST["answer$i"];
            $correct_answers = \tests\get_correct_answers($question_id);
            if ((count($given_answers[$i]) == count($correct_answers)) &&
                !array_diff($given_answers[$i], $correct_answers)) {
                $points++;
            }
        }
$all = $test['num_questions'];
echo "Вы набрали $points баллов из $all";
$percent = $points * 100 / $all;
if ($percent < 60) {
    $mark = 2;
} else if ($percent < 75) {
    $mark = 3;
} else if ($percent < 90.01) {
    $mark = 4;
} else {
    $mark = 5;
}
?>
        <br>
        <?php
        echo "Ваша оценка — $mark";
        if (!$is_training && !$_SESSION['user']['is_teacher']) {
            \tests\append_user_attempt($test['id'], get_user_id(), $points, \tests\get_used_attempts($test['id'], get_user_id()) + 1, $mark);
        }
        ?>
    </div>

    <footer>
        <p>
            <a href="index.php">Главная</a> |
            <?php if (is_logged_in()) { ?>
                <?php if ($_SESSION['user']['is_teacher']) { ?>
                    <a href="teacher_account.php">Личный кабинет</a> |
                <?php } else { ?>
                    <a href="student_account.php">Личный кабинет</a> |
                <?php }
            } ?>
            <a href="course.php">Обучение</a> |
            <a href="rules.php">О курсе</a>
            <?php if (is_logged_in()) { ?>
                | <a href="logout.php">Выход</a>
            <?php } ?>
        </p>
        <p class="my_name">
            Alyona Kovalyova, 2019
        </p>
    </footer>
</main>
</body>
</html>
