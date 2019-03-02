<?php
require_once 'include/authentication.php';
require_once 'header.php.inc';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Настройки учетной записи</title>
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
                    <form method="POST" action="login.php" id="login"">
                        <input type="text" class="logpass" name="login" placeholder="Логин" required>
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
        <div class="content_reg">
            <h1>Настройки</h1>
            <div class="reg_container">
                <h4>Изменить данные учетной записи</h4>
                <form method="post" action="update_settings.php">
                    <input type="text" class="logpass" name="login" pattern=".{3,14}" title="Длина логина должна составлять от 3 до 14 символов" value="<?php echo htmlspecialchars($_SESSION['user']['login'])?>">
                    <?php if (array_key_exists('failed', $_GET)) { ?>
                        <br><span class="error_registration">Такой логин уже существует</span>
                    <?php } ?>
                    <input type="text" class="logpass" name="surname" value="<?php echo htmlspecialchars($_SESSION['user']['surname'])?>">
                    <input type="text" class="logpass" name="name" value="<?php echo htmlspecialchars($_SESSION['user']['name'])?>">
                    <input type="text" class="logpass" name="secname" value="<?php echo htmlspecialchars($_SESSION['user']['second_name'])?>">
                    <input type="password" placeholder="Пароль" class="logpass" name="password" pattern=".{4,}" title="Длина пароля должна составлять не менее 4 символов" >
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
