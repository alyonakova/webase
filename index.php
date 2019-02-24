<?php

require_once 'header.php.inc';
require_once 'include/authentication.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Webase — главная страница</title>
    <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
    <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="main">

    <?php print_header('index') ?>

    <div class="site_content">
        <div class="sidebar_container">
            <?php if (is_logged_in()) { ?>
                <div class="sidebar_2">
                    <h2>
                        Добрый день, <?php echo htmlspecialchars(get_username()); ?>
                    </h2>
                    <a href="settings.php">Настройки</a>
                    <form action="logout.php" class="lables_passreg_text">
                        <button>Выйти из учётной записи</button>
                    </form>
                </div>
            <?php } else { ?>
                <div class="sidebar">
                    <h2>Вход</h2>
                    <?php if (array_key_exists('failed', $_GET)) { ?>
                        <p class="error">Неправильно указан логин или пароль</p>
                    <?php } ?>
                    <form method="POST" action="login.php" id="login">
                        <input type="text" class="logpass" name="login" placeholder="Логин" autofocus required>
                        <input type="password" class="logpass" name="password" placeholder="Пароль" required/>
                        <button type="submit" class="btn">Войти</button>
                    </form>
                    <div class="lables_passreg_text">
                        Впервые на сайте?
                        <a href="registration_page.php">Регистрация</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="content">
            <div class="welcome">Добро пожаловать!
                <hr>
            </div>
            <div class="frst_part">
                <p>
                    <img src="assets/img/site1.png" class="images">
                    Webase — интерактивный онлайн-курс, предназначенный для всех желающих обучиться
                    веб-программированию.
                </p>
                <hr>
            </div>
            <div class="scnd_part">
                <p>
                    <img src="assets/img/test1.png" class="images">
                    Обучение проходит эфффективнее, если теорию закреплять практикой. На нашем сайте после каждого
                    теоретического блока можно пройти тестирование.
                </p>
                <hr>
            </div>
            <div class="thrd_part">
                <p>
                    <img src="assets/img/registration1.png" class="images">
                    Зарегистрируйтесь для получения возможности сохранять свое состояние в обучении или просмотра
                    прогресса ваших учеников, если вы являетесь преподавателем.
                </p>
                <hr>
            </div>
            <div class="frth_part">
                <p>
                    <img src="assets/img/mark1.png" class="images">
                    Получайте баллы за выполненные тесты. Желаем успехов!
                </p>
            </div>
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
