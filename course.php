<?php

require_once 'header.php.inc';
require_once 'include/authentication.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обучение</title>
    <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
    <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="main">

    <?php print_header('course') ?>

    <div class="site_content">
        <div class="sidebar_container">
            <div class="sidebar">
                <h2>План курса:</h2>
                <a><b>Лекция 1</b></a><br>
                <a>Тест 1: обучение</a><br>
                <a>Тест 1: аттестация</a>
                <p></p>
                <a>Лекция 2</a><br>
                <a>Тест 2: обучение</a><br>
                <a>Тест 2: аттестация</a>
            </div>
        </div>
        <div class="content">
            <?php if (is_logged_in()) { ?>
                <?php if (!$_SESSION['user']['is_teacher']) { ?>
                    <!-- отобразить новую лекцию для ученика-->
                <?php } ?>
            <?php } ?>
            <?php if (!is_logged_in()|| $_SESSION['user']['is_teacher']) { ?>
                <!-- отобразить первую лекцию???????если не зареган, новые будут недоступны, для учителя доступны -->
            <?php } ?>

        </div>
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
