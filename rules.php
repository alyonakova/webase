<?php

require_once 'include/authentication.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Правила пользования сайтом</title>
    <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
    <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="main">

    <div class="header">

        <div class="logo">
            <div class="logo_text">
                <h1><a href="index.php">
                    <img src="assets/img/logo2.png" class="logopng">
                    webase
                </a></h1>
                <h2>Обучаемся программированию веб-приложений вместе!</h2>
            </div>
        </div>
        <div class="menubar">
            <ul class="menu">
                <li><a href="index.php">Главная</a></li>
                <li><a href="course.php">Обучение</a></li>
                <li class="selected"><a href="rules.php">О курсе</a></li>
            </ul>

        </div>
    </div>

    <div class="site_content">
        <div class="sidebar_container">
            <div class="sidebar">
                <h2>Вход</h2>
                <form method="post" action="#" id="login">
                    <input type="text" name="login_field" placeholder="Логин" class="logpass"/>
                    <input type="password" name="password_field" placeholder="Пароль" class="logpass"/>
                    <input type="submit" class="btn" value="Войти">
                    <div class="lables_passreg_text">
                        <span>Впервые на сайте?</span>  <span><a href="registration_page.php">Регистрация</a></span>
                    </div>
                </form>
            </div>
        </div>
        <div class="content">
            <div class="welcome">Добро пожаловать!
                <hr>
            </div>
            <div class="frst_part">
                <p>
                    <img src="assets/img/site.png" class="images">
                    Webase — интерактивный онлайн-курс, предназначенный для всех желающих обучиться веб-программированию.
                </p>
                <hr>
            </div>
            <div class="scnd_part">
                <p>
                    <img src="assets/img/test.png" class="images">
                    Обучение проходит эфффективнее, если теорию закреплять практикой. На нашем сайте после каждого теоретического блока можно пройти тестирование.
                </p>
                <hr>
            </div>
            <div class="thrd_part">
                <p>
                    <img src="assets/img/registration.png" class="images">
                    Зарегистрируйтесь для получения возможности сохранять свое состояние в обучении или просмотра прогресса ваших учеников, если вы являетесь преподавателем.
                </p>
                <hr>
            </div>
            <div class="frth_part">
                <p>
                    <img src="assets/img/mark.png" class="images">
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
</div>

</body>
</html>
