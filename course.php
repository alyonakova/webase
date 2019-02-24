<?php

require_once 'header.php.inc';
require_once 'include/authentication.php';
require_once 'include/tests.php';

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
                <?php foreach (\tests\get_all() as $test) { ?>
                    <a href="theory.php?id=<?php echo $test['id'] ?>">
                        <b>Лекция <?php echo $test['ordinal'] ?></b></a>
                    <br>
                    <a href="test.php?training&id=<?php echo $test['id'] ?>">
                        Тест <?php echo $test['ordinal'] ?>:
                        обучение</a>
                    <br>
                    <a href="test.php?id=<?php echo $test['id'] ?>">
                        Тест <?php echo $test['ordinal'] ?>: аттестация
                    </a>
                <?php } ?>
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
