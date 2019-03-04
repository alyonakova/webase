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

    <?php print_header('account'); ?>

    <div class="site_content">
        <div class="sidebar_container">

            <div class="sidebar">
                <h2>Мои группы:</h2>
                <?php if (\groups\has_groups(get_user_id())) { ?>
                    <ul style="list-style: none">
                        <?php foreach (\groups\by_teacher(get_user_id()) as $group) { ?>
                            <li><a href="#" onclick="f_show_group_list(this)"><?php echo $group['name']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <a href="change_log.php">Протокол изменений</a>
                <?php } else { ?>
                    <p>Пока ничего нет</p>
                <?php } ?>

                <form action="create_group.php" method="POST">
                    <h3>Добавить группу</h3>
                    <input type="text" placeholder="Название" name="group">
                    <button>OK</button>
                </form>
            </div>

        </div>
        <div class="content">
            <?php if (\groups\has_groups(get_user_id())) { ?>
                <?php foreach (\groups\by_teacher(get_user_id()) as $group) { ?>
                    <div style="display: none">
                        <span class="group_table"><?php echo $group['name']; ?></span> |
                        <span>id = <?php echo $group['id']; ?></span> | <span><a href="#" onclick="f_show_requests()">Заявки</a></span>
                        <table>
                            <tr>
                                <th class="center">Фамилия</th>
                                <th class="center">Имя</th>
                                <th class="center">Отчество</th>
                                <th class="center">Пройдено тестов</th>
                            </tr>
                            <?php foreach (\groups\get_students_in_group($group['id']) as $student) { ?>
                                <tr>
                                    <td class="center"><?php echo $student['surname'] ?></td>
                                    <td class="center"><?php echo $student['name'] ?></td>
                                    <td class="center"><?php echo $student['second_name'] ?></td>
                                    <td class="center"><?php echo \tests\get_last_done_test_ordinal($student['id']) ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <p></p>
                    </div>


                <?php } ?>
                <section id="request_table" style="display: none">
                    <?php $request_counter = 0; ?>
                    <?php foreach (\groups\by_teacher(get_user_id()) as $group) { ?>
                        <?php $requests = \groups\get_requests_in_group($group['id']); ?>
                        <?php if (!empty($requests)) { ?>
                            <h1 style="font-size: 1.5rem;">
                                В&nbsp;группу <?php echo $group['name'] ?>
                                <span style="color: grey">(id = <?php echo $group['id'] ?>)</span>
                            </h1>
                            <ul style="list-style: square;">
                                <?php foreach ($requests as $request) { ?>
                                    <?php $request_counter++; ?>
                                    <li style="margin-left: 1.1em; margin-bottom: .5em">
                                        <?php $user = get_user_by_id($request['user_id'])[0]; ?>
                                        <?php echo $user['surname'] ?>
                                        <?php echo $user['name'] ?>
                                        <?php echo $user['second_name'] ?>
                                        (id = <?php echo $request['user_id'] ?>)
                                        <br>
                                        <small>
                                            <a href="add_to_group.php?user=<?php echo $request['user_id'] ?>&group=<?php echo $group['id'] ?>">принять</a>
                                            |
                                            <a href="reject_request.php?user=<?php echo $request['user_id'] ?>">отклонить</a>
                                        </small>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($request_counter == 0) { ?>
                        <p>Нет заявок, ожидающих рассмотрения.</p>
                    <?php } ?>
                </section>
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
<script src="scripts.js"></script>
</body>
</html>
