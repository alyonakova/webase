<?php

require_once 'include/tests.php';
require_once 'include/authentication.php';
require_once 'header.php.inc';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лекция</title>
    <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
    <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="main">
    <?php
    print_header('course');

    $id = $_GET['id'];
    $test = \tests\get_test_info($id);
    ?>
    <div class="site_content">
    <article class="theory">
        <h1>Лекция №&nbsp;<?php echo $test['ordinal']; ?></h1>
        <div>
            <?php echo $test['html_theory'] ?>
        </div>
    </article>

    <a href="test.php?training&id=<?php echo $id ?>">Пройти обучающий тест №&nbsp;<?php echo $test['ordinal'] ?></a>
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
