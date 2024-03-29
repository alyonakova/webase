<?php
require_once 'include/authentication.php';
require_once 'include/registration.php';
require_once 'header.php.inc';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
    <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="main">

    <?php print_header('index') ?>
    <div class="site_content">
        <div class="sidebar_container">
            <div class="instruction_img">
                <img src="assets/img/bulb.png" class="images">
            </div>
            <div>
                <h2>Инструкция</h2>
                    <ul>
                        <li>Придумайте себе уникальный логин.</li>
                        <li>Введите свои фамилию, имя и отчество.</li>
                        <li>Если вы являетесь преподавателем, выберите "Я — преподаватель" для получения возможности создавать группы и контролировать процесс обучения своих учеников.
                        Если вы являетесь студентом, выберите "Я — ученик" для получения возможности найти своего преподавателя и вступить к нему в группу.</li>
                        <li>Придумате пароль, который вы будете использовать при входе на сайт.</li>
                    </ul>
            </div>
        </div>
        <div class="content_reg">
            <h1>Регистрация</h1>
            <div class="reg_container">
                <div class="error_registration" id="all_empty" style="display: none">Все поля должны быть заполнены</div>
                <form method="post" action="registration.php" id="reg" onsubmit="return f_validate_form(this)">
                    <input type="text" placeholder="Логин" class="logpass" name="login"> <!--pattern=".{3,14}" title="Длина логина должна составлять от 3 до 14 символов" id="user_login" required -->
                    <div class="error_registration" id="login_length" style="display: none">Длина логина должна составлять от 3 до 14 символов</div>
                    <?php if (array_key_exists('failed', $_GET)) { ?>
                        <br><span class="error_registration">Такой логин уже существует</span>
                    <?php } ?>
                    <input type="text" placeholder="Фамилия" class="logpass" name="surname">
                    <input type="text" placeholder="Имя" class="logpass" name="name">
                    <input type="text" placeholder="Отчество" class="logpass" name="secname">
                    <p>
                        <label>
                            <input type="radio" value="student" name="stud_teach" checked required> Я — ученик
                        </label>
                        <label>
                            <input type="radio" value="teacher" name="stud_teach"> Я — преподаватель
                        </label>
                    </p>
                    <input type="password" placeholder="Пароль" class="logpass" name="password"><!-- pattern=".{4,}" title="Длина пароля должна составлять не менее 4 символов" id="password" required-->
                    <div class="error_registration" id="password_length" style="display: none">Длина пароля должна составлять не менее 4 символов</div>
                    <div>
                        <input type="submit" value="Отправить" class="btn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>
            <a href="index.php">Главная</a> |
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
<script src="scripts.js"></script>
</body>
</html>
