<?php
require_once 'header.php.inc';
require_once 'include/groups.php';
require_once 'include/authentication.php';
require_once 'include/tests.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
    <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="main">

    <?php print_header('account') ?>

    <div class="site_content">
        <div class="sidebar_container">
            <div class="sidebar">
            <h2>Моя группа:</h2>
                <?php $student_has_group = \groups\student_has_group(get_user_id());
                if ($student_has_group) {?>
                    <ul style="list-style: none">
                        <li><?php echo \groups\get_student_group_name(get_user_id()); ?></li>
                    </ul>
                <?php } else {?>
                    <p id="no_groups">Пока ничего нет</p>
                <?php } ?>

                <a class="btn <?php if (!$student_has_group) {echo "disabled";}?>" href="leave_group.php">Покинуть</a>
                <a class="btn <?php if ($student_has_group) {echo "disabled";}?>" href="#" onclick="f_show_group_form()">Найти</a>

                <?php if (array_key_exists('req_error', $_GET)) { ?>
                    Вы уже отправили запрос в группу
                <?php } ?>
                <?php if (array_key_exists('gr_error', $_GET)) { ?>
                    Группы с таким id не найдено
                <?php } ?>
                <?php if (array_key_exists('success', $_GET)) { ?>
                    Заявка отправлена
                <?php } ?>
                <form method="POST" action="send_request.php" style="display:none" id="find_group_form">
                    <input type="text" placeholder="id группы" name="send_req" required>
                    <button>Подать заявку</button>
                </form>
            </div>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th class="center">Номер теста</th>
                    <th class="center">Набрано баллов</th>
                    <th class="center">Максимально</th>
                    <th class="center">Оценка</th>
                </tr>
                <?php foreach (\tests\get_all_done_tests(get_user_id()) as $test) {?>
                <tr>
                    <td class="center"><?php echo \tests\get_test_info($test['test_id'])['ordinal'] ?></td>
                    <td class="center"><?php echo $test['points'] ?></td>
                    <td class="center"><?php echo \tests\get_test_info($test['test_id'])['max_points'] ?></td>
                    <td class="center"><?php echo $test['mark'] ?></td>
                </tr>
                <?php } ?>
            </table>


        </div>
    </div>

    <footer>
        <p>
            <a href="index.php">Главная</a> |
            <?php if (is_logged_in()) { ?>
                <a href="student_account.php">Личный кабинет</a> |
            <?php } ?>
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
