<?php

require_once 'include/tests.php';
require_once 'include/authentication.php';
require_once 'header.php.inc';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лекция</title>
    <meta name="description" content="webase — интерактивный курс по веб-программированию"/>
    <meta name="keywords" content="программирование, тесты, HTML, CSS, JavaScript, PHP"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="main">
    <?php
    print_header('index');

    $id = $_GET['id'];
    $test = \tests\get_test_info($id);
    ?>

    <article class="theory">
        <h1>Теория к тесту №&nbsp;<?php echo $test['ordinal']; ?></h1>
        <p>
            <?php echo $test['html_theory'] ?>
        </p>
    </article>

    <a href="test.php?training&id=<?php echo $id ?>">Пройти обучающий тест №&nbsp;<?php echo $test['ordinal'] ?></a>

</main>
</body>
</html>
