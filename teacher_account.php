<?php
require_once 'include/groups.php';
require_once 'include/authentication.php';
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
                <li class="selected"><a href="teacher_account.php">Личный кабинет</a></li>
                <li><a href="course.php">Обучение</a></li>
                <li><a href="rules.php">О курсе</a></li>
                <?php if (is_logged_in()) { ?>
                    <li><a href="logout.php">Выход</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
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
                   <span class="group_table"><?php echo $group['name']; ?></span> | <span>id = <?php echo $group['id']; ?></span> | <span><a href="#" onclick="f_show_requests()">Заявки</a></span>
                        <table>
                        <tr>
                            <th class="center">Фамилия</th>
                            <th class="center">Имя</th>
                            <th class="center">Отчество</th>
                            <th class="center">Пройдено тестов</th>
                        </tr>
                        <?php foreach (\groups\get_students_in_group($group['id']) as $student) { ?>
                        <tr>
                            <td class="center"><?php echo $student['surname']?></td>
                            <td class="center"><?php echo $student['name']?></td>
                            <td class="center"><?php echo $student['second_name']?></td>
                            <td class="center"></td>
                        </tr>
                    <?php } ?>
                    </table>
                        <p></p>
                    </div>


                <?php } ?>
                <div id="request_table" style="display: none">
                    <table>
                        <tr>
                            <th class="center">В группу</th>
                            <th class="center">id группы</th>
                            <th class="center">id ученика</th>
                            <th class="center">Фамилия</th>
                            <th class="center">Имя</th>
                            <th class="center">Отчество</th>
                            <th class="center">Принять</th>
                        </tr>
                        <?php foreach (\groups\by_teacher(get_user_id()) as $group) { ?>
                        <?php foreach (\groups\get_requests_in_group($group['id']) as $request) { ?>
                            <tr>
                                <td class="center"><?php echo $group['name'] ?></td>
                                <td class="center"><?php echo $group['id'] ?></td>
                                <td class="center"><?php echo $request['user_id']?></td>
                                <?php foreach (get_user_by_id($request['user_id']) as $user) {?>
                                    <td class="center"><?php echo $user['surname']?></td>
                                    <td class="center"><?php echo $user['name']?></td>
                                    <td class="center"><?php echo $user['second_name']?></td>
                                    <td class="center"><a href="add_to_group.php?user=<?php echo $request['user_id']?>&group=<?php echo $group['id']?>">да</a> |
                                        <a href="reject_request.php?user=<?php echo $request['user_id']?>">нет</a></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                    </table>
                </div>
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
