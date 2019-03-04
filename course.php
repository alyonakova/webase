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
                <?php $last_done = \tests\get_last_done_test_ordinal(get_user_id()); ?>
                <?php foreach (\tests\get_all() as $test) { ?>
                    <?php if ($_SESSION['user']['is_teacher'] || $test['ordinal'] <= $last_done + 1) { ?>
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
                        <p></p>
                    <?php } else { ?>
                        <div style="color:grey">
                            Лекция и тест <?php echo $test['ordinal'] ?> для вас пока недоступны.
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="content">
            <div class="welcome">Начните проходить обучение уже сейчас!
                <hr>
            </div>
            <div class="frst_part">
                <?php if (!is_logged_in()) { ?>
                    <p>Если вы хотите иметь доступ ко всему курсу и сохранять свое состояние в обучении, мы рекомендуем вам <a
                                href='registration_page.php'>зарегистрироваться</a>.</p>
                <?php } else if ($_SESSION['user']['is_teacher']) { ?>
                    <p>Мы рады представить вам наш курс! Вы можете ознакомиться с ним, прочитав лекции и пройдя тесты.
                        Весь курс доступен вам уже сейчас!</p>
                    <p>Для своих учеников вы можете задать <a href="#" onclick="f_show_attempts()"
                                                              style="text-decoration: underline">количество попыток</a>
                        на каждый тест.</p>
                <?php } else { ?>
                    <p>Чтобы не запоминать, где вы остановились, нужный вам
                        блок отображается в плане курса. Просто нажмите на него и продолжайте ваше обучение. Помните,
                        что при повторном прохождении теста сохраняется последний результат. Желаем
                        удачи!</p>
                <?php } ?>
            </div>
            <div style="display: none" id="attempt_table">
                <table>
                    <tr>
                        <th class="center">Номер теста</th>
                        <th class="center">Количество попыток</th>
                        <th class="center">Изменить</th>
                    </tr>
                    <?php foreach (\tests\get_all() as $test) { ?>
                        <form action="change_attempt.php" method="post" name="form<?php echo $test['id'] ?>">
                            <tr>
                                <td><?php echo $test['ordinal'] ?>
                                    <input type="hidden" name="test_id"
                                           value="<?php echo $test['id'] ?>"/>
                                </td>
                                <td><?php echo \tests\get_max_possible_attempts($test['id'], get_user_id()) ?></td>
                                <td><input type="text" name="attempt">
                                    <button type="submit">ок</button>
                                </td>
                            </tr>
                        </form>
                    <?php } ?>
                </table>
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
    <script src="scripts.js"></script>
</main>
</body>
</html>
