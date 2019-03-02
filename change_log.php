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
    <title>Протокол изменений</title>
    <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
    <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="main">
    <?php print_header('account') ?>

    <div class="site_content">
        <h1>Протокол изменений</h1>
        <div class="content">
            <?php if (\groups\has_groups(get_user_id())) { ?>
            <table>
                <tr>
                    <th class="center">Фамилия</th>
                    <th class="center">Имя</th>
                    <th class="center">Отчество</th>
                    <th class="center">Группа</th>
                    <th class="center">Номер теста</th>
                    <th class="center">Баллы</th>
                    <th class="center">Оценка</th>
                    <th class="center">Попытка</th>
                    <th class="center">Дата</th>
                </tr>
                <?php foreach (\groups\by_teacher(get_user_id()) as $group) { ?>
                <?php foreach (\groups\get_students_in_group($group['id']) as $student) { ?>
                        <?php foreach (\tests\get_all_done_tests($student['id']) as $test){?>
                <tr>
                    <td class="center"><?php echo $student['surname']?></td>
                    <td class="center"><?php echo $student['name']?></td>
                    <td class="center"><?php echo $student['second_name']?></td>
                    <td class="center"><?php echo \groups\get_student_group_name($student['id'])?></td>
                    <td class="center"><?php echo \tests\get_test_info($test['test_id'])['ordinal']?></td>
                    <td class="center"><?php echo $test['points']?></td>
                    <td class="center"><?php echo $test['mark']?></td>
                    <td class="center"><?php echo $test['attempt']?></td>
                    <td class="center"><?php echo $test['date']?></td>
                </tr>
                        <?php } ?>
                <?php } ?>
                <?php } ?>
            </table>
            <?php } ?>
        </div>
    </div>

    <footer>
        <p>
            <a href="index.php">Главная</a> |
            <?php if (is_logged_in()) { ?>
                <a href="teacher_account.php">Личный кабинет</a> |
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

</body>
</html>

